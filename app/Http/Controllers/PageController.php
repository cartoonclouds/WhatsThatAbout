<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Page::class, 'page');
    }


    /**
     * Display a listing of the Page.
     */
    public function index()
    {
        return view('pages.index');
    }

    /**
     * Page the form for creating a new Page.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Page in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified Page.
     *
     * @param  \App\Models\Page $page
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Page the form for editing the specified Page.
     *
     * @param  \App\Models\Page $page
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified Page in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Page         $page
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified Page from storage.
     *
     * @param  \App\Models\Page $page
     */
    public function destroy(Page $page)
    {
        //
    }
}
