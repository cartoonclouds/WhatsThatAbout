<?php


namespace App\Http\Controllers;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->authorizeResource(Setting::class, 'setting');
    }

    public function index()
    {
        dd('settings');
    }
}
