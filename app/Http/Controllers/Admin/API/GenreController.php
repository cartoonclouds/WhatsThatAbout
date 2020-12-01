<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Genre::class, 'genre');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Genre $genre
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->json([
            'message' => "Successfully deleted genre $genre->title!",
        ]);
    }
}
