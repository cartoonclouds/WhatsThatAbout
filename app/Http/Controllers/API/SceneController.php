<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSceneRequest;
use App\Models\Scene;
use Illuminate\Http\Request;

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
     * Store a newly created Scene or update as specific Scene in storage.
     *
     * @param  \App\Http\Requests\StoreSceneRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrCreate(StoreSceneRequest $request, Scene $scene)
    {
        if ($scene->exists) {
            $scene = $request->persist($scene);

            if ($scene) {
                return response()->json([
                    'message' => "Successfully updated scene $scene->title!",
                    'scene' => $scene
                ]);
            }

            return response()->json([
                'message' => "There was an issue updating the scene $scene->title. Please try again!",
            ]);
        } else {
            $scene = $request->persist(new Scene());

            if ($scene) {
                return response()->json([
                    'message' => "Successfully created new scene $scene->title!",
                    'scene' => $scene
                ]);
            }

            return response()->json([
                'message' => "There was an issue creating the scene $scene->title. Please try again!",
            ]);
        }
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
        $scene->delete();

        return response()->json([
            'message' => 'Successfully deleted scene!'
        ]);
    }
}
