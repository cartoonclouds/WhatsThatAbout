<?php

namespace App\Http\Controllers;

use App\Models\Segment;

class SegmentViewController extends Controller
{

    public function __invoke(Segment $segment)
    {
        $this->authorize('view', $segment);

        return view('segments.show', compact('segment'));
    }
}
