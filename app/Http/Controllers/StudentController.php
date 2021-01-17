<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Student;
use App\Models\User;
use App\Providers\CalculatePrice;
use Illuminate\Http\Request;
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

        $books = Book::orderBy('title')->get();
        $userStudents = User::student()->get();

        if (Auth::user()->isAdministrator) {
            return redirect()->route('users.index');
        }

        foreach ($userStudents as $userStudent) {
            if ($userStudent->suspended == 1) {
                Auth::logout();
                \request()->session();
                return redirect('/')->with('message',
                    'Vous avez été suspendus, contactez M. Spirlet pour plus d\'informations');
            }
        }


        return view('students.dashboard', compact('books', 'userStudents'));
    }

}
