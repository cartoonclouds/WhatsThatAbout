<?php

namespace App\Http\Controllers\Admin\API;

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
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Format $format
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Format $format)
    {
        $format->delete();

        return response()->json([
            'message' => "Successfully deleted format $format->title!",
        ]);
    }
}
