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
        $books = Book::selectRaw('bab_books.id,bab_books.title,bab_books.orientation,bab_books.academic_years,bab_books.picture')
            ->join('reservations', 'reservations.book_id', '=', 'books.id')
            ->groupBy('title')
            ->orderBy('academic_years')
            ->orderBy('orientation')
            ->whereHas('orders', function ($order) {
                return $order;
            })->get();
        $oldBook = ['orientation' => '', 'academic_years' => 0,'title'=>''];
        $i = 0;
        return view('admin.purchases.index',
            compact('books','oldBook','i'));
    }

    public function sendNotif(Request $request)
    {
        $users = User::student()->with('orders')->where('suspended',0)->orderBy('name')->get();
        $book = $request['bookTitle'];
        foreach ($users as $user) {
            if (count($user->orders) >= 1) {
                $emails = $user->email;
                Mail::to($emails)->send(new BookReminder($book));
                Session::flash('message', 'Le(s) mail(s) a/ont été envoyer');
            }
        }
        return redirect(route('purchases.index', compact('users')));
    }
}

//@foreach($books as $book)
//    @if($book->academic_years != $oldBook->academic_years)
//                        <section id="bloc{{$book->academic_years}}">
//                            <h3 aria-level="3"
//                                class="rounded-xl my-2 block p-3 sm:px-12 md:px-16 mt-8 mb-2 mx-auto sm:w-2/4 w-3/4 bg-orange-900 text-white text-center text-md border-orange-900 border-2">
//Bloc {{$book->academic_years}}
//                            </h3>
//
//@endif
//                            @if($book->orientation != $oldBook->orientation)
//                                <section>
//                                    <h4 aria-level="4"
//                                        class="mx-auto rounded-xl my-2 block p-3 sm:px-12 md:px-16 mt-8 mb-2 sm:w-2/4 w-3/4 text-center text-md border-orange-900 border-b-2 border-t-2">
//                                        {{$book->orientation}}
//                                    </h4>
//                                    <div
//                                        class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 justify-items-center">
//@endif
//                                        <div class="flex flex-col justify-around gap-8">
//                                            <section class="mb-12 mt-4">
//                                                <h5 aria-level="5" class="text-xl mb-2 hiddenTitle">
//                                                    {{$book->title}}
//                                                </h5>
//                                                <div class="mb-8">
//                                                    <div class="sm:flex flex-col">
//                                                        <img role="img"
//                                                             aria-label="Photo de couverture de {{$book->title}}"
//                                                             class="sm:max-w-xs"
//                                                             src="{{ asset('storage/'.$book->picture) }}"
//                                                             alt="">
//                                                        <div class="mt-4">
//                                                            <p class="text-xl">{{$book->title}}</p>
//                                                            <p class="text-md">{{$book->total_quantity}}
//                                                                commandes</p>
//                                                        </div>
//                                                    </div>
//                                                    <form
//                                                        aria-label="Envoie de notification pour {{$book->title}}"
//                                                        role="form"
//                                                        method="POST"
//                                                        action="{{ route('purchases.sendNotif')}}">
//                                                            @csrf
//                                                        @method('PUT')
//                                                        <input type="hidden" value="{{$book->title}}" name="bookTitle">
//                                                        <button role="button" name="sendNotifBook"
//                                                                class="md:w-64 sm:self-center hover:bg-orange-900 hover:text-white linkAction rounded-xl w-3/4 duration-300 border-2 px-4 mt-4 py-4">
//Envoyer une notification de disponibilité
//</button>
//                                                    </form>
//                                                </div>
//                                            </section>
//                                        </div>
//@if($book->orientation != $oldBook->orientation)
//                                    </div>
//                                </section>
//@endif
//                            @if($book->academic_years != $oldBook->academic_years && $oldBook->academic_years != 0)
//                        </section>
//@endif
//                    @php
//                        if ($loop->index >= 1){
//                            $oldBook = $books[$loop->index -1];
//                        }else{
//                            $oldBook->academic_years = 1;
//                            $oldBook->orientation = '2D';
//                        }
//                    @endphp
//                @endforeach
