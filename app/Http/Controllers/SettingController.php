<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $role = RoleUser::all();
        $userAdmin = User::admin()->get();
        $userStudents = User::student()->get();
        dd($role);

        return view('admin.settings.index', compact('userStudents', 'userAdmin'));
    }
}
