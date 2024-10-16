<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Models\UserSession;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\RegisterRequest;
use App\Models\ApiResponse;
use App\Models\User;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $request['password'] = bcrypt($request['password']);

        $user = User::create($request->all());

        UserSession::create([
            'user_id' => $user->id,
            'login_at' => now(),
        ]);

        return ApiResponse::success(['user' => $user]);
    }

}