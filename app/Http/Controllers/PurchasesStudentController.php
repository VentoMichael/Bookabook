<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\PurchasesStudent;
use App\Models\User;
use Illuminate\Http\Request;

class PurchasesStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $commandDraft = Order::draft()->orderBy('created_at')
            ->with('books')->get();
        $commandNoDraft = Order::noDraft()->orderBy('created_at')
            ->with('books')->get();
        return view('students.purchases.index',compact('user','commandDraft','commandNoDraft'));
    }

    public function draft()
    {
        $user = auth()->user();
        $commandDraft = Order::draft()->orderBy('created_at')
            ->with('books')->get();
        $commandNoDraft = Order::noDraft()->orderBy('created_at')
            ->with('books')->get();
        return view('students.purchases.draft',compact('user','commandDraft','commandNoDraft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchasesStudent  $purchasesStudent
     * @return \Illuminate\Http\Response
     */
    public function show(PurchasesStudent $purchasesStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchasesStudent  $purchasesStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchasesStudent $purchasesStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchasesStudent  $purchasesStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchasesStudent $purchasesStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchasesStudent  $purchasesStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchasesStudent $purchasesStudent)
    {
        //
    }
}
