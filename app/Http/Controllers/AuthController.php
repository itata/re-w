<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Requests\RegisterFormRequest;
use JWTAuth;
use Auth;
use Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterFormRequest $request)
    {
        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->name_alias = $request->name_alias;
        $user->phone = $request->phone;
        $user->sex = $request->sex;
        $user->university_name = $request->university_name;
        $user->university_year = $request->university_year;
        $user->save();
        return response([
            'status' => 'success',
            'data' => $user
        ], 200);
    }
    public function checkEmail($value) {
        $exists = User::where('email', $value)->exists();
        return response()->json([
            'valid' => $exists
        ]);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ( ! $token = JWTAuth::attempt(['email' => request('email'), 'password' => request('password'), 'role' => 'Guest'])) {
                return response([
                    'status' => 'error',
                    'error' => 'invalid.credentials',
                    'msg' => 'Invalid Credentials.'
                ], 400);
        }
        $user = User::find(Auth::user()->id);
        return response([
                'status' => 'success',
                'token' => $token,
                'user' => $user
            ])
            ->header('Authorization', $token);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);

        return response([
                'status' => 'success',
                'data' => $user
            ]);
    }

    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }
    public function logout()
    {
        JWTAuth::invalidate();
        return response([
                'status' => 'success',
                'msg' => 'Logged out Successfully.'
            ], 200);
    }
}
