<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;


class SearchController extends Controller
{

    public function index()
    {
        $userAdmin = User::admin()->get();
        $search = Request::input('search');
        $users = User::where('name', 'LIKE', '%' . $search . '%')->orWhere('surname', 'LIKE', '%' . $search . '%')->where('suspended',0)->where('email','!=','vento.michael0705@hotmail.com')->get();
        $books = Book::where('title', 'LIKE', '%' . $search . '%')->get();
        if (count($users) || count($books)) {
                return view('admin.search.search',compact('users','books','userAdmin'))->withQuery($search);
        } else return view('admin.search.no-result');
    }
}
