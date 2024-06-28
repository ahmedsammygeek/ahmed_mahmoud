<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\StudentExam;
use App\Models\StudentExamAnswer;
use App\Traits\Api\GeneralResponse;
use Auth;
use Carbon\Carbon;
use App\Http\Resources\Api\Student\V1\Exams\ExamResource;
use App\Http\Resources\Api\Student\V1\Exams\ExamQuestionResource;
class ExamController extends Controller
{

    use GeneralResponse;

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {

        $student = Auth::guard('student')->user();
        // we need to check if this exam active or no

        if (!$exam->is_active) {
            return $this->response(
                status : 'error' , 
                message : 'this exams is no active right now' , 
            );
        }


        if ($exam->starts_at->diffInDays(Carbon::now()) < 0 ) {
            return $this->response(
                status : 'error' , 
                message : 'this exams did not started yet to take' , 
            );
        }


        if (Carbon::now()->diffInDays($exam->ends_at) < 0 ) {
            return $this->response(
                status : 'error' , 
                message : 'this exams did not ended  , you can not take it anymore ' , 
            );
        }

        // now we need if this user had examed before or not

        $user_exam = StudentExam::where('student_id' , $student->id )->where('exam_id'  , $exam->id )->latest()->first();

        // dd($user_exam->started_at->diffInMinutes(Carbon::now()) > $exam->duration );

        if ($user_exam) {

            if ($user_exam->started_at->diffInMinutes(Carbon::now()) > $exam->duration ) {
                return $this->response(
                    status : 'error' , 
                    message : 'you had took this exam before and can not take it again' , 
                );
            } else {

                $student_exam_questions  = StudentExamAnswer::with('question')->where('exam_id' , $exam->id )->where('student_id' , $student->id )->where('student_exam_id' , $user_exam->id )->get();

                // dd($student_exam_questions->pluck('question_id')->toArray());
                $data['exam'] = new ExamResource($exam);
                $data['exam_questions'] = ExamQuestionResource::collection($student_exam_questions);

                return $this->response(
                    data : $data , 
                );
            }

        } 


        dd('here start new exam b2a ');

    }

}
