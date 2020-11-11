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
    public function updateOrCreate(StorePageRequest $request, Page $page)
    {
        if ($page->exists) {
            $page = $request->persist($page);

            if ($page) {
                return response()->json([
                    'message' => "Successfully updated page $page->title!",
                    'page' => $page
                ]);
            }

            return response()->json([
                'message' => "There was an issue updating the page $page->title. Please try again!",
            ]);
        } else {
            $page = $request->persist(new Page());

            if ($page) {
                return response()->json([
                    'message' => "Successfully created new page $page->title!",
                    'page' => $page
                ]);
            }

            return response()->json([
                'message' => "There was an issue creating the page $page->title. Please try again!",
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
