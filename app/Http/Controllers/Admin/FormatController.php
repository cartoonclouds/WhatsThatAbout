<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FormatsDataTable;
use App\Http\Controllers\Controller;
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
     * @return \Illuminate\Http\Response
     */
    public function index(FormatsDataTable $dataTable)
    {
        return $dataTable->render('formats.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Format  $format
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Format $format)
    {
        return view('formats.edit', compact('format'));
    }
}
