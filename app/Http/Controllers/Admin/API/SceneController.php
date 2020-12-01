<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Scene;

class SceneController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Scene::class, 'scene');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Scene $scene
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Scene $scene)
    {
        $scene->votes()->delete();

        $scene->comments()->delete();

        $scene->delete();

        return response()->json([
            'message' => "Successfully deleted scene $scene->title!",
        ]);
    }
}
