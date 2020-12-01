<?php

namespace App\Http\Controllers;

use App\Models\Format;

class FormatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Format::class, 'format');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Format $format
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Format $format)
    {
        return view('formats.show', compact('format'));
    }
}
