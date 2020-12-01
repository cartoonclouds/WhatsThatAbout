<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ThemesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreThemeRequest;
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
     * Store a newly created Theme or update as specific Theme in storage.
     *
     * @param  \App\Http\Requests\StoreThemeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrCreate(StoreThemeRequest $request, Theme $theme)
    {
        if ($theme->exists) {
            $theme = $request->persist($theme);

            if ($theme) {
                return response()->json([
                    'message' => "Successfully updated theme $theme->name!",
                    'theme'   => $theme
                ]);
            }

            return response()->json([
                'message' => "There was an issue updating the theme $theme->name. Please try again!",
            ]);
        } else {
            $theme = $request->persist(new Theme());

            if ($theme) {
                return response()->json([
                    'message' => "Successfully created new theme $theme->name!",
                    'theme'   => $theme
                ]);
            }

            return response()->json([
                'message' => "There was an issue creating the theme $theme->name. Please try again!",
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
