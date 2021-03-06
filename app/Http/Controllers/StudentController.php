<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::noDraft()->orderBy('title')->where('stock',">=",1)->get();
        $userStudents = User::student()->get();
        if (Auth::user()->isAdministrator) {
            return redirect()->route('users.index');
        }
        foreach ($userStudents as $userStudent) {
            if ($userStudent->suspended == 1) {
                Auth::logout();
                \request()->session();
                Session::flash('messageBanned',
                    'Vous avez été suspendus, contactez M. Spirlet pour plus d\'informations');
                return redirect('/');
            }
        }
        return view('students.dashboard', compact('books', 'userStudents'));
    }
}
