<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display the login form to user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }
}
