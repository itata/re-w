<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Storage;
use App\Notifications\SignupActivate;
use App\Notifications\SignupActivated;
use App\User;

class AuthController extends Controller
{

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => __('auth.login_failed')
            ], 401);

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        // return response()->json([
        //     'access_token' => $tokenResult->accessToken,
        //     'token_type' => 'Bearer',
        //     'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        // ]);

        return redirect('/admin');
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        //$request->user()->token()->revoke();

        return redirect('/admin');
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
