<?php

namespace Wave\Http\Controllers;

use Auth;
use App\Models\Course;
use App\Models\Enrollment;
use App\Http\Controllers\Controller;

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
        if(tenant()){
            $enrollments = Enrollment::with('course')->where('user_id', Auth::id())->latest()->get()->take(2);
            $libraries = Course::latest()->get()->take(6);

            return view('theme::dashboard.index', compact('enrollments', 'libraries'));
        }

        $user = Auth::user();

        if($user->role->id == 1){
            return redirect('/admin');
        }

        return view('theme::dashboard.central');
    }
}
