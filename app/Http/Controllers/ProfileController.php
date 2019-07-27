<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class ProfileController extends Controller
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
        return view('layouts.frontend.profile');
    }
    public function indexProfile()
    {
        return view('layouts.frontend.profileindex');
    }

    public function userEdit(Request $request, $id) {

        $user = User::findOrFail($id);
        $input = $request->all();
        if ($request->has('password')) $input['password'] = bcrypt($input['password']);;
        $user->update($input);

        return $user;
    }
}
