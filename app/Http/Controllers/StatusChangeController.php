<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\StatusChanges;
use App\Models\User;
use Illuminate\Http\Request;

class StatusChangeController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StatusChanges  $statusChange
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function index(){
        $users = User::student()->with('orders')->where('suspended',0)->orderBy('name')->get();
        $statuses = Status::all();
        $statusesChange = StatusChanges::all();

        return view('admin.statuses.index',compact('statuses','statusesChange'))->with('users', $users);
    }

    public function edit(User $user)
    {

        return view('admin.statuses.edit', compact('status','user'));
    }

    public function update(Request $request, StatusChanges $statusChange)
    {
        dd($request->all());
    }
}
