<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class MasterAcessRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = auth('api')->user();
            if ($user->type->name === 'Master') {
                return $next($request);
            } else {
                return response()->json(['status' => 'Unauthorized']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'Authorization Token not found']);
        }
    }
}
