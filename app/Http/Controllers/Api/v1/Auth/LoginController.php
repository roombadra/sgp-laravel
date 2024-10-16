<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Models\ApiResponse;
use App\Models\UserSession;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!auth()->attempt($credentials)) {
            Log::channel('auth')->warning('Tentative de connexion échouée', [
                'email' => $request->email,
                'password' => $request->password,
                'error' => 'Email or password is wrong!'
            ]);

            $response = ['message' => 'Email or password is wrong!'];

            throw new HttpResponseException(ApiResponse::errors($response, 422));
        }

        $token = auth()->user()->createToken(Controller::SALT)->accessToken;
        $response = [
            'user' => auth()->user(),
            'token' => $token
        ];

        UserSession::create([
            'user_id' => auth()->user()->id,
            'login_at' => now(),
            'logout_at' => null,
        ]);
        Log::channel('auth')->info('Utilisateur connecté', [
            'email' => $request->email,
        ]);

        throw new HttpResponseException(ApiResponse::success($response));
    }
}