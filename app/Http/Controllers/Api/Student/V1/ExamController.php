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
                $data['student_exam_id'] = $user_exam->id;
                $data['student_started_exam_at'] = $user_exam->started_at->toDateTimeString();

                return $this->response(
                    data : $data , 
                );
            }

        } 

        $student_exam = new StudentExam;
        $student_exam->student_id = $student->id;
        $student_exam->exam_id = $exam->id;
        $student_exam->started_at = Carbon::now();
        $student_exam->is_finished = 0;
        $student_exam->save();


        foreach ($exam->questions as $question) {
            $StudentExamAnswer = new StudentExamAnswer;
            $StudentExamAnswer->exam_id = $exam->id;
            $StudentExamAnswer->question_id = $question->id;
            $StudentExamAnswer->student_exam_id = $student_exam->id;
            $StudentExamAnswer->student_id = $student->id;
            $StudentExamAnswer->save();
        }

        $student_exam_questions  = StudentExamAnswer::with('question')->where('exam_id' , $exam->id )->where('student_id' , $student->id )->where('student_exam_id' , $student_exam->id )->get();
        $data['exam'] = new ExamResource($exam);
        $data['exam_questions'] = ExamQuestionResource::collection($student_exam_questions);
        $data['student_exam_id'] = $student_exam->id;
        $data['student_started_exam_at'] = $student_exam->started_at->toDateTimeString();

        return $this->response(
            data : $data , 
            message : 'exam started , good luck' , 

        );
    }



    public function answer(Request $request ,  Exam $exam)
    {

        $student = Auth::guard('student')->user();

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

        $student_exam = StudentExam::where('student_id' , $student->id )->where('exam_id'  , $exam->id )->latest()->first();

        if (!$student_exam) {
            return $this->response(
                status : 'error' , 
                message : 'yoiu did not take this exam' , 
                statusCode : 404
            );
        }

        $question_answer =  StudentExamAnswer::where('exam_id' , $exam->id )->where('student_id' , $student->id )->where('student_exam_id' , $request->student_exam_id )->where('question_id' , $request->question_id )->latest()->first();

        if ($request->filled('answer_content')) {
            $question_answer->answer_content = $request->answer_content;
        } else {
             $question_answer->answer_id = $request->answer_id;
        }
        
        $question_answer->save();

        return $this->response(
            message : 'you hvae answer successfully' , 
        );
    }

    public function result(Exam $exam)
    {
        $data['result'] = 5;

        return $this->response(
            data : $data , 
        );
    }

}
