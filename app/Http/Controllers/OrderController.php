<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;
use App\Models\StatusChanges;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(User $user, $id)
    {
        $order = Order::find($id);
        $statuses = Status::all();
        return view('admin.statuses.edit', compact('statuses', 'user', 'order'));
    }

    public function update(Request $request, $user, $id)
    {
        $statusChanges = StatusChanges::where('order_id', '=', $id)->first();
        $statusChanges->status_id = $request['status'];
        $statusChanges->update();
        Session::flash('message', 'Le status de la commande a été changé');
        return redirect()->route('users.show',['user'=>$user]);
    }
}
