<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $users = User::student()->with('orders')->orderBy('name')->get();

        return view('admin.statuses.index')->with('users', $users);
    }

    public function edit(User $user)
    {
        $statuses = Status::all();

        return view('admin.statuses.edit', compact('statuses','user'));
    }

    public function update(Request $request, Status $status)
    {
        dd($request->all());

    }
}
