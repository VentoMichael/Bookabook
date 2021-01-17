<?php

namespace App\Http\Controllers;

use App\Mail\AccountChanged;
use App\Models\{Order, Reservation, RoleUser, Status, StatusChanges, User};
use Illuminate\Support\Facades\{Auth, Hash, Mail, Session, Storage};
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function suspended()
    {
        $totalUser = User::student()->get();
        $users = User::student()->with('orders')->where('suspended', 0)->orderBy('name')->get();
        $statuses = Status::all();
        $orders = Order::with('user')->get();
        $admin = User::admin()->get();
        $studentSuspended = User::studentSuspended()->with('orders')->get();
        $firstLetters = [];
        $firstLetter = '';
        $totalbooks = 0;
        $letters = [];
        foreach ($studentSuspended as $ss) {
            foreach ($ss->orders as $order) {
                $totalbooks += $order->books->count();
            }
            if (strtoupper(substr($ss->name, 0, 1)) !== $firstLetter) {
                $firstLetter = strtoupper(substr($ss->name, 0, 1));
                array_push($firstLetters, $firstLetter);
            }
            foreach ($firstLetters as $firstLetter) {
                $letters[$firstLetter] = $studentSuspended->filter(function ($ss) use ($firstLetter) {
                    return strpos($ss->name, $firstLetter) === 0;
                });
            }
        }

        return view('admin.user.suspendedStudent',
            compact('admin', 'users', 'studentSuspended', 'orders', 'users', 'statuses', 'letters', 'totalbooks'));

    }

    public function index()
    {
        $totalUser = User::student()->get();

        $statuses = Status::all();
        $orders = Order::with('user')->get();
        $admin = User::admin()->get();
        $studentSuspended = User::studentSuspended()->with('orders')->get();
        $users = User::student()->with('orders')->where('suspended', '0')->orderBy('name')->get();
        $firstLetters = [];
        $firstLetter = '';
        $totalbooks = 0;

        foreach ($users as $user) {
            foreach ($user->orders as $order) {
                $totalbooks += $order->books->count();
            }
            $firstLetter = strtoupper(substr($user->name, 0, 1));
            array_push($firstLetters, $firstLetter);
        }
        $letters = [];
        foreach ($firstLetters as $firstLetter) {
            $letters[$firstLetter] = $users->filter(function ($user) use ($firstLetter) {
                return strtoupper(substr($user->name, 0, 1)) == $firstLetter;
            });
        }

        return view('admin.user.index',
            compact('admin', 'studentSuspended', 'orders', 'totalUser', 'users', 'statuses', 'letters', 'totalbooks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function show(User $user)
    {
        $userCurrent = auth()->user();
        $admin = User::admin()->get();
        $totalbooks = 0;
        foreach ($user->orders as $order) {
            $totalbooks += $order->books->count();
        }
        return view('admin.user.show', compact('user', 'userCurrent', 'admin', 'totalbooks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */


    public function edit()
    {
        $user = auth()->user();
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        //if ($request->has('status')){
        //    $order->status_id = $request['status'];
        //    $order->order_id = '1';
        //    $order->update();
        //}
        if ($request->has('suspend')) {
            $user->suspended = true;
            $user->update();
                            Session::flash('message', $user->name.' a bien été suspendu');

            return redirect()->route('users.show',['user'=>$user->name]);
        }
        if ($request->has('noSuspend')) {
            $user->suspended = false;
            $user->update();
                            Session::flash('message', $user->name.' n\'est plus suspendu');

            return redirect()->route('users.show',['user'=>$user->name]);
        }
        $attributes = request()->validate([
            'file_name' => 'image|mimes:jpeg,png,jpg|max:2048',
            'email' => [
                'string',
                'email',
                'max:255',
            ],
        ]);
        if (request('password')) {
            $attributes = request()->validate([
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'confirmed'
                ]
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
        if (request('bank_account')) {
            $user->bank_account = request('bank_account');
        }
        $user->update($attributes, $request->all());
        if (request('email')) {
            Mail::to($attributes['email'])
                ->send(new AccountChanged());
        }
        if ($user->wasChanged()) {
                Session::flash('message', 'Vos informations ont été changés avec succès');
        } else {
            Session::flash('messageNotUpdate', 'Il n\'y a rien a changé');
        }
        Session::flash('messageBook', 'Vos informations ont été changés avec succès');
        return redirect(route('users.edit', ['user' => $user->name]));
    }

}
