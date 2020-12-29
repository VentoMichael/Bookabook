<?php

namespace App\Http\Controllers;

use App\Mail\AccountChanged;
use App\Mail\BookCreated;
use App\Mail\BookReminder;
use App\Models\Book;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
        $userAdmin = User::admin()->get();
        $books = Book::selectRaw('SUM(reservations.quantity) as total_quantity,books.id,books.title,books.orientation,books.academic_years,books.picture')
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
        $userStudents = null;
        return view('admin.purchases.index',
            compact('books','userStudents', 'userAdmin', 'oldBook'));
    }

    public function sendNotif(Request $request)
    {
        $users = User::student()->with('orders')->orderBy('name')->get();
        $book = $request['bookTitle'];
        foreach ($users as $user) {
            if (count($user->orders) >= 1) {
                $emails = $user->email;
                Mail::to($emails)->send(new BookReminder($book));
            }
        }
        return redirect(route('purchases.index', compact('users')));
    }
}
