<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ScenesDataTable;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ScenesDataTable $dataTable)
    {
        return $dataTable->render('scenes.index');
    }
}
