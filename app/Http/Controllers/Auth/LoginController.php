<?php

namespace App\Http\Controllers\Auth;

use Wave\Http\Controllers\Auth\LoginController as AuthLoginController;

class LoginController extends AuthLoginController
{
    public function showLoginForm()
    {
        if(tenancy()->tenant){
            return view('theme::auth_tenant.login');
        }
        return view('theme::auth.login');
    }
}
