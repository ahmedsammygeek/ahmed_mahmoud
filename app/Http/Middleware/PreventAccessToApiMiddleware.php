<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;
use App\Traits\Api\GeneralResponse;
class PreventAccessToApiMiddleware
{
    use GeneralResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settings = Setting::first();

        if (!$settings->access_api) {
            return $this->response(
                statusCode : 403 , 
                status : 'error' , 
                message: $settings->api_access_message , 
            );
        }


        return $next($request);
    }
}
