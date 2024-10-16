<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected const SALT = 'nKvXuJPrCXWQujFNJdBIXFyjR2/jD5coUMpv8FKVOUvcsRKMW+rWKCiNKmjsYNiStgWE8oLIqB4G2l/AAkMnfX8xhG6DOx9FK19hBsKBMIjqROBzNwDDay9W5KGIbAyagZHwF9Td+QcU9MxVMMBpMNVr97FME/r7WXyft1kS1lk=';
}