<?php

namespace App\Http\Controllers;

use App\Models\RoleUser;
use App\Models\User;

class SettingController extends Controller
{
    public function index()
    {
        $roles = RoleUser::all();
        foreach ($roles as $role){
            if ($role->role_id === 1){
                $userAdmin = User::admin()->get();
                $userStudents = null;

            }else{
                $userStudents = User::student()->get();
                $userAdmin = null;
            }
        }
        return view('admin.settings.index', compact('userStudents', 'userAdmin'));
    }
}
