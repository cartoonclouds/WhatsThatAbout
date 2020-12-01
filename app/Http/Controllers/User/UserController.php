<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
}
