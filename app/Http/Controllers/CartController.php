<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
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
        return redirect()->route('dashboardUser.index')->with('messageBook', $book->title . ' a été ajouter au panier');
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
    public function update($id){
        // Get the product
        $book = Book::find($id);

        dd(\request()->all());
        // Check if the user entered an ADD quantity
        if (\request()->get('add_quantity')) {
            $book->stock += 1;
        } elseif (\request()->get('remove_quantity')) {
            $book->stock -= 1;
        }

        // Save the changes
        $book->update();

        return redirect()->view('students.cart.shopping-cart');
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
        Session::forget('cart');
        return view('students.cart.checkout', compact('total', 'admin', 'user'));
    }
}
