<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PagesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Page::class, 'page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PagesDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.index');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('pages.admin.edit', ['page' => new Page]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theme  $page
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Page $page)
    {
        return view('pages.admin.edit', compact('page'));
    }
}
