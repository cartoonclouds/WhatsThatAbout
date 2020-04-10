<?php

namespace App\Http\Controllers\API;

use App\Contracts\Votable;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends APIController
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ?Vote $vote, Votable $votable)
    {
        //
    }

}
