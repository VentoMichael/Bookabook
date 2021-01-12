<?php

namespace App\Http\Controllers;

use App\Models\RoleUser;
use App\Models\User;

class SettingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.settings.index',compact('user'));
    }
}
