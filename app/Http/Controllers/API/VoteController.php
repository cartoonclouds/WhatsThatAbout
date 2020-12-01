<?php

namespace App\Http\Controllers\API;

use App\Contracts\Votable;
use App\Http\Controllers\Controller;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Vote::class, 'vote');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Contracts\Votable   $votable
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Votable $votable)
    {
        //save a new vote
        // api/page/{page}/vote
        // api/scene/{scene}/vote
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Vote         $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        //update a vote
        // api/vote/{vote}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Vote $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        //delete a vote
        // api/vote/{vote}
    }
}
