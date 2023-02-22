<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Auth::user()->courses()->latest()->get()->take(2);

        return view('theme::dashboard.index', compact('courses'));
    }
}
