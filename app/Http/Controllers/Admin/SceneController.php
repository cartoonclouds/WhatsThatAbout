<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ScenesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSceneRequest;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ScenesDataTable $dataTable)
    {
        return $dataTable->render('scenes.admin.index');
    }


    /**
     * Store a newly created Scene or update as specific Scene in storage.
     *
     * @param  \App\Http\Requests\StoreSceneRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrStore(StoreSceneRequest $request, Scene $scene)
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('scenes.admin.edit', ['scene' => new Scene]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theme  $page
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Scene $scene)
    {
        return view('scenes.admin.edit', compact('scene'));
    }

}
