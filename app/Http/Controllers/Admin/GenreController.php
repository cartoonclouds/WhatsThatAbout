<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\GenresDataTable;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GenresDataTable $dataTable)
    {
        return $dataTable->render('genres.admin.index');
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
