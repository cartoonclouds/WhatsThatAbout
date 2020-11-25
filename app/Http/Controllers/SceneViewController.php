<?php

namespace App\Http\Controllers;

use App\Models\Scene;

class SceneViewController extends Controller
{

    public function __invoke(Scene $scene)
    {
        $this->authorize('view', $scene);

        return view('scenes.show', compact('scene'));
    }
}
