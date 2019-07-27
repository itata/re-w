<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
        if ($request->has('password')) $input['password'] = bcrypt($input['password']);;
        $user->update($input);

        return $user;
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $code = str_random(60);
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return $user;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return '';
    }

}
