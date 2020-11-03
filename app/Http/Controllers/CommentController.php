<?php

namespace App\Http\Controllers;

use App\Contracts\Commentable;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * Display a listing of the Comment.
     */
    public function index()
    {
        //
    }

    /**
     * Page the form for creating a new Comment.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified Comment.
     *
     * @param  \App\Models\Comment  $comment
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Page the form for editing the specified Comment.
     *
     * @param  \App\Models\Comment  $comment
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified Comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified Comment from storage.
     *
     * @param  \App\Models\Comment  $comment
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
