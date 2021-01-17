<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use App\Providers\CalculatePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function getAddToCart(Request $request, $id)
    {
        $book = Book::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($book, $book->id);
        $request->session()->put('cart', $cart);
        return redirect()->route('dashboardUser.index')->with('messageBook', $book->title.' a été ajouter au panier');
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('students.cart.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('students.cart.shopping-cart', ['books' => $cart->items, 'totalPrice' => $cart->totalPrice]);
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
        return view('students.cart.checkout', compact('total', 'admin', 'user'));
    }

    public function create(Request $request)
    {
        if (!Session::has('cart')) {
            return view('students.cart.shopping-cart');
        }
        $books = Book::all();

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        $admin = User::admin()->firstOrFail();
        $user = auth()->user();
        $order = new Order();
        $order->user_id = auth()->user()->id;
        if ($request->has('save')) {
            $order->is_draft = 1;
            Session::flash('messageSavePayment','Votre commande à bien été sauvegardée');
        }
            $order->save();
            $reservation = new Reservation();
            $reservation->total_price = $cart->totalPrice;
            $reservation->order_id = $order->id;
            foreach ($cart as $key => $value) {
                $reservation->book_id = $value;
                //dd($value);
            }
            $reservation->save();
            Session::flash('messagePayment','Votre commande à bien été prise en compte');

        Session::forget('cart');
        return redirect()->route('dashboardUser.index', compact('total', 'books', 'admin', 'user'));
    }
}
