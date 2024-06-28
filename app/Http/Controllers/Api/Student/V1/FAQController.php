<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQ;
use App\Traits\Api\GeneralResponse;
use App\Http\Resources\Api\Student\V1\FAQs\QuestionResource;
class FAQController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = FAQ::get(); 


        $data['questions'] = QuestionResource::collection($questions);

        return $this->response(

            data : $data , 
        );
    }

  
}
