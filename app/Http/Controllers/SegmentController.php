<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use Illuminate\Http\Request;

class SegmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Segment::class, 'segment');
    }

    /**
     * Display a listing of the Segment.
     */
    public function index()
    {
        //
    }

    /**
     * Page the form for creating a new Segment.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Segment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified Segment.
     *
     * @param  \App\Models\Segment  $segment
     */
    public function show(Segment $segment)
    {
        //
    }

    /**
     * Page the form for editing the specified Segment.
     *
     * @param  \App\Models\Segment  $segment
     */
    public function edit(Segment $segment)
    {
        //
    }

    /**
     * Update the specified Segment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Segment  $segment
     */
    public function update(Request $request, Segment $segment)
    {
        //
    }

    /**
     * Remove the specified Segment from storage.
     *
     * @param  \App\Models\Segment  $segment
     */
    public function destroy(Segment $segment)
    {
        //
    }
}
