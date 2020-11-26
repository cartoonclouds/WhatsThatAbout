<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Page;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['pages'] = Page::paginate(10);

        flash('Testing flash')->error();

        return view('home', $data);
    }
}
