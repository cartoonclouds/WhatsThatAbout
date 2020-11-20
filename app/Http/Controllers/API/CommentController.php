<?php

namespace App\Http\Controllers\API;

use App\Contracts\Commentable;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Models\Page;
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
     * Display a listing of the resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function index(Page $page)
    {
        dd('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function create(Page $page)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Page $page)
    {
        //save a new comment
        // api/page/{page}/comment
        // api/segment/{segment}/comment
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contracts\Commentable  $commentable
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Commentable $commentable, Comment $comment)
    {
        dd($commentable, $comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page, Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page, Comment $comment)
    {
        //update a comment
        // api/comment/{comment}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page, Comment $comment)
    {
        //delete a comment
        // api/comment/{comment}
    }
}
