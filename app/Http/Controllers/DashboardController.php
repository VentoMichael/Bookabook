<?php

namespace App\Http\Controllers;

use App\Models\{Order, User};

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::student()->with('orders')->orderBy('name')->get();
        $orders = Order::all();
        $totalbooks = 0;
        $statuses = [
            'paid' => 'Payé',
            'available' => 'Disponible au bureau',
            'delivered' => 'Delivré',
            'ordered' => 'Commandé',
        ];
        $firstLetters = [];
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
        return view('admin.dashboard', compact('users', 'orders', 'statuses', 'letters', 'totalbooks'));
    }
}
