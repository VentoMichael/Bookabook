<?php

namespace App\Http\Controllers;

use App\Mail\AccountChanged;
use App\Mail\BookCreated;
use App\Mail\BookReminder;
use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use stdClass;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $books = Book::selectRaw('SUM(reservations.quantity) as total_quantity,books.title,books.orientation,books.academic_years,books.picture')
            ->join('reservations', 'reservations.book_id', '=', 'books.id')
            ->groupBy('title')
            ->orderBy('academic_years')
            ->orderBy('orientation')
            ->whereHas('orders', function ($order) {
                return $order;
            })->get();
        $oldBook = new StdClass();
        $oldBook->academic_years = 0;
        $oldBook->orientation = '';

        return view('admin.purchases.index',
            compact('books', 'oldBook'));
    }

    public function sendNotif()
    {
        $books = Book::selectRaw('SUM(reservations.quantity) as total_quantity,books.title,books.orientation,books.academic_years,books.picture')
            ->join('reservations', 'reservations.book_id', '=', 'books.id')
            ->groupBy('title')
            ->orderBy('academic_years')
            ->orderBy('orientation')
            ->whereHas('orders', function ($order) {
                return $order;
            })->get();
        $users = User::student()->with('orders')->orderBy('name')->get();
        foreach ($users as $user) {
            foreach ($books as $book) {
                dd($book->title);
                $emails = $user->email;
                Mail::to($emails)->send(new BookReminder($book));
            }
        }
        return redirect(route('purchases.index'));
    }
}
