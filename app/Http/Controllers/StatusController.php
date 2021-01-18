<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $users = User::student()->with('orders')->where('suspended',0)->orderBy('name')->get();
        return view('admin.statuses.index')->with('users', $users);
    }

    public function edit(User $user)
    {
        $statuses = Status::all();
        return view('admin.statuses.edit', compact('statuses','user'));
    }
}
