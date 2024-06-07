<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class StudentMustVerifyHisPhoneNumberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $student = Auth::guard('student')->user();
        if (!$student->phone_verified_at) {
            
            return response()->json([
                'errors' => [] , 
                'message' => trans('api.mobile phone must be verified') , 
                'data' => (object)[] ,
                'status' => 'error' ,  
            ], 403);

        }


        return $next($request);
    }
}
