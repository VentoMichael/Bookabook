<?php

namespace App\Http\Controllers;

use App\Mail\AccountChanged;
use App\Models\{Order, Reservation, Status, StatusChanges, User};
use Illuminate\Support\Facades\{Hash, Mail, Session, Storage};
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::student()->with('orders')->orderBy('name')->get();
        $statuses = Status::all();
        $orders = Order::with('user')->get();

        $userAdmin = User::admin()->get();
        $firstLetters = [];
        $firstLetter = '';
        $totalbooks = 0;
        foreach ($users as $user) {
            foreach ($user->orders as $order) {
                $totalbooks += $order->books->count();
            }
            if (strtoupper(substr($user->name, 0, 1)) !== $firstLetter) {
                $firstLetter = strtoupper(substr($user->name, 0, 1));
                array_push($firstLetters, $firstLetter);
            }
        }
        $letters = [];
        foreach ($firstLetters as $firstLetter) {
            $letters[$firstLetter] = $users->filter(function ($user) use ($firstLetter) {
                return strpos($user->name, $firstLetter) === 0;
            });
        }

        return view('admin.user.index', compact('userAdmin', 'orders', 'users', 'statuses', 'letters', 'totalbooks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function show(User $user)
    {
        $totalbooks = 0;
        foreach ($user->orders as $order) {
            $totalbooks += $order->books->count();
        }
        return view('admin.user.show', compact('user', 'order', 'totalbooks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */


    public function edit()
    {
        $user = User::admin()->get();
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user,StatusChanges $order)
    {
        dd($order);
        if ($request['status']){
            dd('d');
        }
        if ($user->isDirty()) {
            $attributes = request()->validate([
                'file_name' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'email' => [
                    'string',
                    'email',
                    'max:255',
                ]
            ]);
            if (request('password')) {
                request()->validate([
                    'password' => [
                        'required',
                        'string',
                        'min:8',
                        'regex:/[a-z]/',
                        'regex:/[A-Z]/',
                        'regex:/[0-9]/',
                        'confirmed'
                    ],
                ]);
            }
            if ($request->hasFile('file_name')) {
                Storage::makeDirectory('users');
                $filename = request('file_name')->hashName();
                $img = Image::make($request->file('file_name'))
                    ->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(storage_path('app/public/users/'.$filename));
                $attributes['file_name'] = 'users/'.$filename;
            }
            if (request('email')) {
                $attributes['email'] = request('email');
            }
            if (request('password')) {
                $attributes['password'] = Hash::make(request('password'));
            }
            $user->update($attributes);
            if (request('email')) {
                Mail::to($attributes['email'])
                    ->send(new AccountChanged());
            }
            Session::flash('message', 'Vos informations ont été changés avec succès');
            return redirect(route('users.show', ['user' => $user->name]));
        } else {
            Session::flash('message', 'Il n\'y a rien a changé');
            return redirect(route('users.show', ['user' => $user->name]));
        }
    }

}
