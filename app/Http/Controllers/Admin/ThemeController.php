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
        return $dataTable->render('themes.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Theme $theme)
    {
        return view('themes.edit', compact('theme'));
    }
}
