<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FormatsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormatRequest;
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
        return $dataTable->render('formats.admin.index');
    }


    /**
     * Store a newly created Format or update as specific Format in storage.
     *
     * @param  \App\Http\Requests\StoreFormatRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrCreate(StoreFormatRequest $request, Format $format)
    {
        if ($format->exists) {
            $format = $request->persist($format);

            if ($format) {
                return response()->json([
                    'message' => "Successfully updated format $format->name!",
                    'format'  => $format
                ]);
            }

            return response()->json([
                'message' => "There was an issue updating the format $format->name. Please try again!",
            ]);
        } else {
            $format = $request->persist(new Format());

            if ($format) {
                return response()->json([
                    'message' => "Successfully created new format $format->name!",
                    'format'  => $format
                ]);
            }

            return response()->json([
                'message' => "There was an issue creating the format $format->name. Please try again!",
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
        return view('formats.admin.edit', ['format' => new Format]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Format  $format
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Format $format)
    {
        return view('formats.admin.edit', compact('format'));
    }
}
