<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageViewController extends Controller
{

    public function __invoke(Page $page)
    {
        $this->authorize('view', $page);

        return view('pages.show', compact('page'));
    }

}
