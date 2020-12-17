<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SaveBookController extends Controller
{
    public function index()
    {
        $booksDraft = Book::draft()->orderBy('title')
            ->get();
        return view('admin.book.draft', compact('booksDraft'));
    }

    public function create()
    {
        return view('admin.book.create');
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
            $img = Image::make($book->picture)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/books/'.$filename));
            $book->picture = 'books/'.$filename;
        }
        $book->picture = request('picture')->store('books');
        $book->title = request('title');
        $book->author = request('author');
        $book->publishing_house = request('publishing_house');
        $book->isbn = request('isbn');
        if (request('orientation')) {
            $book->orientation = request('orientation');
        }
        $book->orientation = request('orientation');
        $book->presentation = request('presentation');
        $book->public_price = request('public_price');
        $book->proposed_price = request('proposed_price');
        $book->stock = request('stock');
        $book->is_draft = true;
        $book->save();
        Session::flash('message', 'Livre créer avec succès');
        return \redirect(route('books.show', ['book' => $book->title]));
    }
}
