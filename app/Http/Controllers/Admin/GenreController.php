<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\GenresDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreRequest;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GenresDataTable $dataTable)
    {
        return $dataTable->render('genres.admin.index');
    }


    /**
     * Store a newly created Genre or update as specific Genre in storage.
     *
     * @param  \App\Http\Requests\StoreGenreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrCreate(StoreGenreRequest $request, Genre $genre)
    {
        if ($genre->exists) {
            $genre = $request->persist($genre);

            if ($genre) {
                return response()->json([
                    'message' => "Successfully updated genre $genre->name!",
                    'genre' => $genre
                ]);
            }

            return response()->json([
                'message' => "There was an issue updating the genre $genre->name. Please try again!",
            ]);
        } else {
            $genre = $request->persist(new Genre());

            if ($genre) {
                return response()->json([
                    'message' => "Successfully created new genre $genre->name!",
                    'genre' => $genre
                ]);
            }

            return response()->json([
                'message' => "There was an issue creating the genre $genre->name. Please try again!",
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
        return view('genres.admin.edit', ['genre' => new Genre]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Genre $genre)
    {
        return view('genres.admin.edit', compact('genre'));
    }
}
