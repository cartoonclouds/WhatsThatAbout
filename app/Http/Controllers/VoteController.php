<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Vote::class, 'vote');
    }

    /**
     * Display a listing of the Vote.
     */
    public function index()
    {
        //
    }

    /**
     * Page the form for creating a new Vote.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Vote in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified Vote.
     *
     * @param  \App\Models\Vote  $vote
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Page the form for editing the specified Vote.
     *
     * @param  \App\Models\Vote  $vote
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified Vote in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vote  $vote
     */
    public function update(Request $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified Vote from storage.
     *
     * @param  \App\Models\Vote  $vote
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
