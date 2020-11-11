<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSegmentRequest;
use App\Models\Segment;
use Illuminate\Http\Request;

class SegmentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Segment::class, 'segment');
    }


    /**
     * Store a newly created Segment or update as specific Segment in storage.
     *
     * @param  \App\Http\Requests\StoreSegmentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrCreate(StoreSegmentRequest $request, Segment $segment)
    {
        if ($segment->exists) {
            $segment = $request->persist($segment);

            if ($segment) {
                return response()->json([
                    'message' => "Successfully updated segment $segment->title!",
                    'segment' => $segment
                ]);
            }

            return response()->json([
                'message' => "There was an issue updating the segment $segment->title. Please try again!",
            ]);
        } else {
            $segment = $request->persist(new Segment());

            if ($segment) {
                return response()->json([
                    'message' => "Successfully created new segment $segment->title!",
                    'segment' => $segment
                ]);
            }

            return response()->json([
                'message' => "There was an issue creating the segment $segment->title. Please try again!",
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Segment $segment
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Segment $segment)
    {
        $segment->delete();

        return response()->json([
            'message' => 'Successfully deleted segment!'
        ]);
    }

}
