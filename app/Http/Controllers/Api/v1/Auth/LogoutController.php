<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Models\ApiResponse;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Laravel\Passport\Token;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Token::where('user_id', auth()->user()->id)->update([
            'revoked' => true,
        ]);

        $session = UserSession::where('user_id', auth()->user()->id)
            ->latest('created_at')
            ->first();

        $session?->update([
            'logout_at' => now(),
        ]);

        $message = 'You have been successfully logged out!';

        return ApiResponse::success($message);
    }
}