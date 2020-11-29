<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ThemesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Theme;

class ThemeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Theme::class, 'theme');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ThemesDataTable $dataTable)
    {
        return $dataTable->render('themes.admin.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('themes.admin.edit', ['theme' => new Theme]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Theme $theme)
    {
        return view('themes.admin.edit', compact('theme'));
    }
}
