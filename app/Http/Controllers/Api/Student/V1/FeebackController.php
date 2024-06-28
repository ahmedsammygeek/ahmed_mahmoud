<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Traits\Api\GeneralResponse;
use App\Http\Requests\Api\Student\V1\Feedback\StoreFeedBackRequest;
use App\Models\Feedback;
class FeebackController extends Controller
{
    use GeneralResponse;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedBackRequest $request)
    {
        $student = Auth::guard('student')->user();
        $feedback = new Feedback;
        $feedback->student_id = $student->id;
        $feedback->content = $request->content;
        $feedback->save();

        return $this->response(

            message : 'thanks for your Feedback' , 
        );
    }

  
}
