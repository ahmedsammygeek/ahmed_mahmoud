<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationalSystem;
use App\Traits\Api\GeneralResponse;
use App\Http\Resources\Api\Student\V1\EducationalSystemResource;
class EducationalSystemController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $systems = EducationalSystem::where('is_active' , 1 )->get();

        $data = [
            'educational_systems' => EducationalSystemResource::collection($systems) , 
        ];


        return $this->response(

            data : $data , 
        );
    }

   
}
