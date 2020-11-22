<?php

namespace App\Http\Controllers\API;

use App\Contracts\Commentable;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\Commentable  $commentable
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Commentable $commentable)
    {
        //save a new comment
        // api/page/{page}/comment
        // api/segment/{segment}/comment
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\Commentable  $commentable
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
//        dd('updating');
        //update a comment
        // api/comment/{comment}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contracts\Commentable  $commentable
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //delete a comment
        // api/comment/{comment}
    }
}
