<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class SettingStudentController extends Controller
{
    public function index(){
        $user = auth()->user();
        $commandDraft = Order::draft()->orderBy('created_at')
            ->with('books')->get();
        $commandNoDraft = Order::noDraft()->orderBy('created_at')
            ->with('books')->get();
        return view('students.settings.index',compact('user','commandDraft','commandNoDraft'));
    }
}
