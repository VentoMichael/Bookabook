<?php

namespace App\Http\Controllers;

use App\Mail\BookCreated;
use App\Mail\BookReminder;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $userAdmin = User::admin()->get();
        $books = Book::noDraft()->orderBy('title')
            ->get();
        $booksDraft = Book::draft()->orderBy('title')
            ->get();
        $firstLetters = [];
        $firstLetter = '';
        foreach ($books as $book) {
            if (strtoupper(substr($book->title, 0, 1)) !== $firstLetter) {
                $firstLetter = strtoupper(substr($book->title, 0, 1));
                array_push($firstLetters, $firstLetter);
            }
        }
        $letters = [];
        foreach ($firstLetters as $firstLetter) {
            $letters[$firstLetter] = $books->filter(function ($book) use ($firstLetter) {
                return strpos($book->title, $firstLetter) === 0;
            });
        }
        return view('admin.book.index', compact('books', 'userAdmin', 'booksDraft', 'letters'));
    }

    public function draft()
    {
        $userAdmin = User::admin()->get();
        $booksDraft = Book::draft()->orderBy('title')
            ->get();
        return view('admin.book.draft', compact('booksDraft', 'userAdmin'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //sauvegardes
        $booksDraft = $book->get();
        $userAdmin = User::admin()->get();
        //non sauvegardes
        $booksNoDraft = Book::noDraft()
            ->get();

        return view('admin.book.show', compact('book', 'userAdmin', 'booksDraft', 'booksNoDraft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $booksDraft = Book::draft()->orderBy('title')
            ->get();
        $userAdmin = User::admin()->get();
        return view('admin.book.create', compact('booksDraft', 'userAdmin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {

        $book = new Book($this->validateBook());
        if ($request->hasFile('picture')) {
            Storage::makeDirectory('books');
            $filename = request('picture')->hashName();
            $img = Image::make($request->file('picture'))->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/books/'.$filename));
            $book->picture = 'books/'.$filename;
        }
        $book->title = request('title');
        $book->author = request('author');
        $book->publishing_house = request('publishing_house');
        $book->academic_years = request('academic_years');
        $book->isbn = request('isbn');
        if (request('orientation')) {
            $book->orientation = request('orientation');
        }
        $book->orientation = request('orientation');
        $book->presentation = request('presentation');
        $book->public_price = request('public_price');
        $book->proposed_price = request('proposed_price');
        $book->stock = request('stock');
        $book->is_draft = $request->has('save');
        $book->save();
        if ($book->is_draft) {
            Session::flash('message', 'Livre sauvegardé avec succès');
        } else {
            $users = User::student()->with('orders')->orderBy('name')->get();
            foreach ($users as $user) {
                $emails = $user->email;
                Mail::to($emails)->send(new BookCreated($book));
            }
            Session::flash('message', 'Livre créer avec succès');
        }
        return \redirect(route('books.show', ['book' => $book->title]));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $userAdmin = User::admin()->get();
        $booksDraft = Book::draft()->orderBy('title')
            ->get();
        return view('admin.book.edit', compact('book', 'userAdmin', 'booksDraft'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Book $book)
    {

        if ($request->has('publish')) {
            $book->is_draft = false;
            $book->update();
        } else {
            $validatedData = request($this->validateBook());
            if ($request->hasFile('picture')) {
                $filename = request('picture')->hashName();
                Image::make($request->file('picture'))->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/books/'.$filename));
                $book->picture = 'books/'.$filename;
            }
            $book->title = request('title');
            $book->author = request('author');
            $book->publishing_house = request('publishing_house');
            $book->isbn = request('isbn');
            if (request('orientation')) {
                $book->orientation = request('orientation');
            }
            $book->presentation = request('presentation');
            $book->public_price = request('public_price');
            $book->proposed_price = request('proposed_price');
            $book->stock = request('stock');
            $book->update($validatedData);
        }
        if ($book->is_draft) {
            Session::flash('message', 'Livre sauvegardé avec succès');
        } else {
            Session::flash('message', 'Livre éditer avec succès');
        }
        if ($book->wasChanged()) {
            Session::flash('message', 'Livre éditer avec succès');
        } else {
            Session::flash('messageNotUpdate', 'Il n\'y a rien a changé');
        }
        return redirect(route('books.index', ['book' => $book]));

    }

    protected function validateBook()
    {
        return request()->validate([
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'author' => 'required',
            'publishing_house' => 'required',
            'isbn' => 'required',
            'orientation' => 'required',
            'public_price' => 'required',
            'proposed_price' => 'required',
            'stock' => 'required',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return string
     */
    public
    function destroy(
        Book $book,
        Request $request
    ) {
        $book->delete();
        Session::flash('message', 'Livre supprimé avec succès');
        return Redirect::to(route('books.index'));
    }
}
