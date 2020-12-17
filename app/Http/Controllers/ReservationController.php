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

        //$books2DFirstYear = $books->where('orientation', '2D')->where('academic_years', '1');
        //$books3DFirstYear = $books->where('orientation', '3D')->where('academic_years', '1');
        //$booksWebFirstYear = $books->where('orientation', 'Web')->where('academic_years', '1');

        return view('admin.purchases.index',
            compact('books'));
    }

    public function sendNotif()
    {
        $books = Book::selectRaw('SUM(reservations.quantity) as total_quantity,books.title,books.orientation,books.academic_years,books.picture')
            ->join('reservations', 'reservations.book_id', '=', 'books.id')
            ->groupBy('title')
            ->whereHas('orders', function ($order) {
                return $order;
            })->get();
        $users = User::student()->with('orders')->orderBy('name')->get();
        foreach ($users as $user) {
            foreach ($books as $book) {
                $emails = $user->email;
                Mail::to($emails)->send(new BookReminder($book));
            }
        }
        return redirect(route('purchases.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
