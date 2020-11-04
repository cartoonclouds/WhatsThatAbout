<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Page::class, 'page');
    }


    /**
     * Store a newly created Page or update as specific Page in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrCreate(Page $page, StorePageRequest $request)
    {
        if ($page->exists) {
            $page = $request->persist($page);

            if ($page) {
                return response()->json([
                    'message' => 'Successfully updated page!'
                ]);
            }

            return response()->json([
                'message' => 'There was an issue updating the page. Please try again.',
            ]);
        } else {
            $page = $request->persist(new Page());

            if ($page) {
                return response()->json([
                    'message' => 'Successfully created new page!'
                ]);
            }

            return response()->json([
                'message' => 'There was an issue creating the page. Please try again.',
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return response()->json([
            'message' => 'Successfully deleted page!'
        ]);
    }

}
