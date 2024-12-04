<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class redirectIfBlockedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('student')->check()) {
            $user = Auth::guard('student')->user();
            
            if ($user->is_banned == 1 ) {
                $message = 'تم عمل بلوك للحساب الخاص بك';

                if ($user->banning_message) {
                    $message = $user->banning_message;
                }

                return response()->json([
                    'status' => 'error' , 
                    'errors' => [] , 
                    'data' => (object)[] , 
                    'message' => $message
                ], 401);
            }
        }

        return $next($request);
    }
}
