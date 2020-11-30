<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.admin.index');
    }


    /**
     * Store a newly created User or update as specific User in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrCreate(StoreUserRequest $request, User $user)
    {
        if ($user->exists) {
            $user = $request->persist($user);

            if ($user) {
                return response()->json([
                    'message' => 'Successfully updated user!'
                ]);
            }

            return response()->json([
                'message' => 'There was an issue updating the user. Please try again.',
            ]);
        } else {
            $user = $request->persist(new User());

            if ($user) {
                return response()->json([
                    'message' => 'Successfully created new user!'
                ]);
            }

            return response()->json([
                'message' => 'There was an issue creating the user. Please try again.',
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return view('users.admin.edit', compact('user'));
    }
}
