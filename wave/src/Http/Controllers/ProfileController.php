<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index($username){
    	$user = config('wave.user_model')::where('email', '=', $username)->firstOrFail();
    	return view('theme::profile', compact('user'));
    }
}
