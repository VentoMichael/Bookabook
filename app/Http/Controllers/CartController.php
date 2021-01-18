<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\StatusChanges;
use App\Models\User;
use App\Providers\CalculatePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request, $id)
    {
        $book = Book::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($book, $book->id);
        $request->session()->put('cart', $cart);
        return redirect()->route('dashboardUser.index')->with('messageBook', $book->title.' a été ajouter au panier');
    }

    public function reduceByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.shoppingCart');
    }

    public function addByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addByOne($id);
            Session::put('cart', $cart);
        return redirect()->route('product.shoppingCart');
    }

    public function removeItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.shoppingCart');
    }

    public function cart()
    {
        if (!Session::has('cart')) {
            return view('students.cart.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('students.cart.shopping-cart', [
            'books' => $cart->items,
            'totalPrice' => $cart->totalPrice,
        ]);
    }

    public function checkout()
    {
        if (!Session::has('cart')) {
            return view('students.cart.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        $admin = User::admin()->firstOrFail();
        $user = auth()->user();
        return route('checkout.index', compact('total', 'admin', 'user'));
    }

    public function create(Request $request)
    {
        if (!Session::has('cart')) {
            return view('students.cart.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        $admin = User::admin()->firstOrFail();
        $user = auth()->user();
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->total_price = $cart->totalPrice;
        if (\request()->has('quantity')) {
            foreach ($cart->items as $item => $v) {
                $v['stock'] = \request('quantity');
                return \redirect()->route('product.shoppingCart');
            }
        }
        $order->save();
        if ($request->has('save')) {
            $order->is_draft = 1;
            $order->save();
            foreach ($cart->items as $item) {
                $reservation = new Reservation();
                $reservation->order_id = $order->id;
                $reservation->quantity = $item['stock'];
                $reservation->book_id = $item['item']['id'];
                $reservation->save();
            }
            Session::forget('cart');
            Session::flash('messageSavePayment', 'Votre commande a bien été sauvegardée');
            return redirect()->route('dashboardUser.index');
        }
        $status = new StatusChanges();
        $status->status_id = 1;
        $status->order_id = $order->id;
        $status->save();
        foreach ($cart->items as $item) {
            $reservation = new Reservation();
            $reservation->order_id = $order->id;
            $reservation->quantity = $item['stock'];
            $reservation->book_id = $item['item']['id'];
            $books = Book::noDraft()->where('id', '=', $item['item']['id'])->get();
            foreach ($books as $b) {
                $b->stock = $b->stock - $item['stock'];
                $b->update();
            }
            $reservation->save();
        }
        Session::forget('cart');
        Session::flash('messagePayment', 'Votre commande à bien été prise en compte');
        return view('students.cart.checkout', compact('total', 'admin', 'user'));
    }
}
