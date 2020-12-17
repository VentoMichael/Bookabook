<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $user = User::admin()->get();
        return view('admin.settings.index',compact('user'));
    }
}
