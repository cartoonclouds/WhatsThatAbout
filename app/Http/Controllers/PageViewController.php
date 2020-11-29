<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageViewController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Page $page)
    {
        $this->authorize('view', $page);

        return view('pages.show', compact('page'));
    }
}
