<?php

namespace App\Http\Controllers;

use App\Mail\AccountChanged;
use App\Models\{Status, User};
use Illuminate\Support\Facades\{Hash, Mail, Storage};
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response|\Illuminate\View\View
     */
    // TODO : mail notifications if order is changed
    public function index()
    {
        $users = User::student()->with('orders')->orderBy('name')->get();
        $statuses = [
            'paid' => 'Payé',
            'available' => 'Disponible',
            'delivered' => 'Delivré',
            'ordered' => 'Commandé',
        ];
        switch ($statuses) {
            case 'paid':
                echo "Payé";
                break;
            case 'available':
                echo "Disponible";
                break;
            case 'delivered':
                echo "Delivré";
                break;
            case 'ordered':
                echo "Commandé";
                break;
        }
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

        return view('admin.user.index', compact('userAdmin','users', 'statuses', 'letters','totalbooks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function show(User $user)
    {
        $userAdmin = User::admin()->get();
        $totalbooks = 0;

        // TODO : send message in button
        foreach ($user->orders as $order) {
            $totalbooks += $order->books->count();
        }
        return view('admin.user.show', compact('user', 'userAdmin','totalbooks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function status(){
        $users = User::student()->with('orders')->orderBy('name')->get();

        return view('admin.statuses.index')->with('users',$users);
    }
    public function statusEdit(){
        $statuses = Status::all();

        return view('admin.statuses.edit',compact('statuses'));
    }
    public function statusEditUpdate(Request $request, Status $status){
        $attributes['status'] = request('status');
        dd($request->all());
        $status->update($attributes);
        return redirect(route('users.status'));
    }


    public function edit()
    {
        $user = User::admin()->get();
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
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
        $attributes['email'] = request('email');
        $attributes['password'] = Hash::make(request('password'));

        $user->update($attributes);
        Mail::to($attributes['email'])
            ->send(new AccountChanged());
        return redirect(route('users.show', ['user' => $user->name]));
    }

}
