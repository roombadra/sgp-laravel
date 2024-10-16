<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiResponse extends Model
{
    public static function success($data, int $code = 200)
    {
        return response()->json([
            'http_code' => $code,
            'success' => true,
            'data' => $data
        ], $code);
    }

    public static function errors($errors, int $code = 400)
    {
        return response()->json([
            'http_code' => $code,
            'success' => false,
            'errors' => $errors
        ], $code);
    }
}