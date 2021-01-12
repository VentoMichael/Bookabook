<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SettingStudentController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('students.settings.index',compact('user'));
    }
}
