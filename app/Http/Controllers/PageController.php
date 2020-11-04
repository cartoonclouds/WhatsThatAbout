<?php

namespace App\Http\Controllers;

use App\Models\Page;

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
        return view('pages.edit');
    }

    /**
     * Display the specified Page.
     *
     * @param  \App\Models\Page $page
     */
    public function show(Page $page)
    {
        return view('pages.show', compact('page'));
    }

    /**
     * Page the form for editing the specified Page.
     *
     * @param  \App\Models\Page $page
     */
    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

}
