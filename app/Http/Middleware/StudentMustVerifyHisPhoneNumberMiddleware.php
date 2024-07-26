<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Models\Setting;
class StudentMustVerifyHisPhoneNumberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $Setting = Setting::first();

        if ($Setting->force_phone_verification == 1 ) {
            $student = Auth::guard('student')->user();
            if (!$student->phone_verified_at) {
                
                return response()->json([
                    'errors' => [] , 
                    'message' => trans('api.mobile phone must be verified') , 
                    'data' => (object)[] ,
                    'status' => 'error' ,  
                ], 403);

            }
        }




        return $next($request);
    }
}
