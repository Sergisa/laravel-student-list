<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJson
{
    public function handle(Request $request, Closure $next)
    {
        $request->headers->add([
            "Accept" => '/json'
        ]);
        return $next($request);
    }
}
