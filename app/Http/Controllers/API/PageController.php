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
     * Store a newly created Page in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePageRequest $request)
    {
        if ($page = $request->persist(new Page())) {
            return response()->json([
                'message' => 'Successfully created new page!'
            ]);
        }

        return response()->json([
            'message' => 'There was an issue creating the page. Please try again.',
        ]);
    }


    /**
     * Update the specified Page in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @param  \App\Models\Page         $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StorePageRequest $request, Page $page)
    {
        if ($page = $request->persist($page)) {
            return response()->json([
                'message' => 'Successfully updated page!'
            ]);
        }

        return response()->json([
            'message' => 'There was an issue updating the page. Please try again.',
        ]);
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
