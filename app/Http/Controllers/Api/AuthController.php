<?php

namespace App\Http\Controllers\Api;

use Auth;
use Mail;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            if (!$request->user()->hasVerifiedEmail()) {
                throw ValidationException::withMessages([
                    'email' => trans('auth.failed')
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'token' => $request->user()->api_token
                ]
            ]);
        }

        throw ValidationException::withMessages([
            'email' => trans('auth.failed')
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create(array_merge($request->all(), [
            'role_id' => Role::select('id')->where('name', 'Pengguna')->first()->id,
            'name' => sprintf('%s %s', $request->first_name, $request->last_name),
            'password' => Hash::make($request->password)
        ]));

        $user->sendEmailVerificationNotification();

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        
    }
}
