<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Splash;
use App\Http\Resources\Api\Student\V1\Splashes\SplashResource;

use App\Traits\Api\GeneralResponse;
class SplashController extends Controller
{

    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $splashes = Splash::get();

        $data['splashes'] = SplashResource::collection($splashes);

        return $this->response(

            data : $data , 
        );
    }


}
