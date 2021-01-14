<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RoleUser;
use App\Models\User;

class SettingController extends Controller
{
    public function index()
    {
        $booksDraft = Book::draft()->orderBy('title')
            ->get();
        $user = auth()->user();
        return view('admin.settings.index',compact('user','booksDraft'));
    }
}
