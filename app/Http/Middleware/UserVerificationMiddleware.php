<?php


namespace App\Http\Middleware;


use Closure;
use Exception;
use Illuminate\Http\Request;

class UserVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = $request->user();
            if ($user) {
                return $next($request);
            }
        } catch (Exception $exception) {
        }
        return response()->json(['error' => true, 'errors' => ['message' => 'You are not authorized to use this resource.']], 401);
    }
}
