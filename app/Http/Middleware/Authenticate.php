<?php

namespace App\Http\Middleware;

use App\Helpers\HttpResponse;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        //return $request->expectsJson() ? null : route('login');

        if($request->is('api/*')) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'errors' => 'Access denied'
            ], HttpResponse::STATUS_UNAUTHORIZED));
        }

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
