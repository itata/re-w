<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\User;
use App\Http\Requests\RegisterFormRequest;
use JWTAuth;
use Auth;
use Validator;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.frontend.login');
    }

    public function logout(Request $request)
    {
        return view('layouts.frontend.logout');
    }
}
