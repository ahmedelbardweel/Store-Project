<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class ApiKeyAuth
{
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY') ?: $request->query('api_key');

        if (!$apiKey) {
            return response()->json(['message' => 'API Key is missing'], 401);
        }

        $user = User::where('api_key', $apiKey)->first();
        if (!$user) {
            return response()->json(['message' => 'Invalid API Key'], 401);
        }

        // خزّن المستخدم في الريكوست
        $request->merge(['auth_user' => $user]);

        return $next($request);
    }
}
