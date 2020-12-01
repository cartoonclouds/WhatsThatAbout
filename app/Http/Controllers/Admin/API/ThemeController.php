<?php

namespace App\Http\Controllers\Admin\API;

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
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Theme $theme
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Theme $theme)
    {
        $theme->delete();

        return response()->json([
            'message' => "Successfully deleted theme $theme->title!",
        ]);
    }
}
