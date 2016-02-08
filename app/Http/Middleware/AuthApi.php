<?php
namespace App\Http\Middleware;

use App\ApiKey;
use Closure;

class AuthApi
{

    static public function getAPI()
    {
        if (!function_exists('getallheaders')) {
            function getallheaders()
            {
                $headers = '';
                foreach ($_SERVER as $name => $value) {
                    if (substr($name, 0, 5) == 'HTTP_') {
                        $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                    }
                }
                return $headers;
            }
        }
        $header = getallheaders();

        if (isset($header['Apikey'])) {

            return $header['Apikey'];
        }
        return false;
    }

    public function handle($request, Closure $next)
    {
//        if ($key = AuthApi::getAPI()) {
//            $auth = ApiKey::where("apikey", $key)->first();
//
//            if (count($auth) <= 0) {
//                return response()->json([
//                    'error' => 401,
//                    'message' => 'Invalid authenticated params !',
//                    "API_KEY" => $key], 401
//                );
//            }
//            return $next($request);
//        } else {
//            return response()->json([
//                'error' => 401,
//                'message' => 'Invalid authenticated params !'
//            ], 401
//            );
//        }
    }
}