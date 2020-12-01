<?php

namespace App\Http\Controllers;

use App\Models\Scene;
use Illuminate\Contracts\View\View;

class SceneViewController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scene  $scene
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Scene $scene): View
    {
        $this->authorize('view', $scene);

        return view('scenes.show', compact('scene'));
    }
}
