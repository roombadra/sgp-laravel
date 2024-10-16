<?php

namespace App\Http\Middleware\Api\v1;

use App\Models\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdministratorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->profile_id == \App\Models\Profile::admin()->id) {
            return $next($request);
        } else {
            return ApiResponse::errors('You are not authorized to access this route', 403);
        }
    }
}