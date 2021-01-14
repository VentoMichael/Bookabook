<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\{Order, Role, RoleUser, Status, User};

class DashboardController extends Controller
{
    public function index()
    {
        if(!Auth::user()->isAdministrator)
            redirect()->route('dashboard.index');

        $users = User::student()->with('orders')->where('suspended',0)->orderBy('name')->get();
        $orders = Order::all();
        $totalbooks = 0;
        $statuses = Status::all();
        $firstLetters = [];
        $userAdmin = User::admin()->get();
        $roleAdmin = Role::where('id',1)->with('users')->get();
        $roleUser = Role::where('id',2)->with('users')->get();
        $firstLetter = '';
        foreach ($users as $user) {
            if (strtoupper(substr($user->name, 0, 1)) !== $firstLetter) {
                $firstLetter = strtoupper(substr($user->name, 0, 1));
                array_push($firstLetters, $firstLetter);
            }
            foreach ($user->orders as $order) {
                $totalbooks += $order->books->count();
            }
        }
        $letters = [];
        foreach ($firstLetters as $firstLetter) {
            $letters[$firstLetter] = $users->filter(function ($user) use ($firstLetter) {
                return strpos($user->name, $firstLetter) === 0;
            });
        }
        return view('admin.dashboard', compact('users','userAdmin', 'orders', 'statuses', 'letters', 'totalbooks'));
    }
}
