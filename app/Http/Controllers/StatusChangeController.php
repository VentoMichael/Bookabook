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
    public function update(Request $request, StatusChanges $statusChange)
    {
        //$statusChange = StatusChanges::all()->where('order_id','=',1);

        //$statusChange->save($statusChange);
        //return redirect(route('users.index'));
    }
    public function index(){
        $users = User::student()->with('orders')->orderBy('name')->get();
        $statuses = Status::all();
        $statusesChange = StatusChanges::all();

        return view('admin.statuses.index',compact('statuses','users','statusesChange'));
    }
}
