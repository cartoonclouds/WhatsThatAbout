<?php

namespace App\Http\Controllers\API;

use App\Contracts\Commentable;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Commentable::class, 'comment');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Comment $comment)
    {
        //save a new comment
        // api/page/{page}/comment
        // api/segment/{segment}/comment
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @param  \App\Contracts\Commentable $commentable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment, Commentable $commentable)
    {
        //update a comment
        // api/comment/{comment}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @param  \App\Contracts\Commentable $commentable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment, Commentable $commentable)
    {
        //delete a comment
        // api/comment/{comment}
    }
}
