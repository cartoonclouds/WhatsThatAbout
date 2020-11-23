<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SegmentsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Segment;

class SegmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Segment::class, 'segment');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SegmentsDataTable $dataTable)
    {
        return $dataTable->render('segments.index');
    }
}
