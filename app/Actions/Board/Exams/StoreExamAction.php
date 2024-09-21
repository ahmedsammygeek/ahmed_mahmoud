<?php

namespace App\Actions\Board\Exams;
use App\Models\{ExamQuestion  , StudentExam , Exam , Question };
use Auth;
use Carbon\Carbon;

class StoreExamAction
{
    

    public function execute($data)
    {
        $dates =  explode(' - ', $data['date']);
        $exam = new Exam;
        $exam->setTranslation('title' , 'ar' , $data['title_ar'] );
        $exam->setTranslation('title' , 'en' , $data['title_en'] );
        $exam->user_id = Auth::id();
        $exam->course_id = $data['course_id'];
        $exam->duration = $data['duration'];
        $exam->lesson_id = array_key_exists('lesson_id' ,  $data ) ? $data['lesson_id'] : null ;
        $exam->retry_count = $data['retry_count'];
        $exam->question_limit = $data['question_limit'];
        $exam->starts_at = new Carbon($dates[0]) ;
        $exam->ends_at =  new Carbon($dates[1]) ;
        $exam->is_active = 1;
        $exam->pass_degree = $data['pass_degree'] ;
        $exam->can_student_see_result = array_key_exists('can_student_see_result', $data) ? 1 : 0;
        $exam->can_user_re_exam = array_key_exists('can_user_re_exam', $data) ? 1 : 0;
        $exam->save();
        $total_degree = 0 ;
        $questions = Question::find($data['questions']);
        $exam->total_degree = $questions->sum('degree');
        $exam->save();
        $exam_questions = [];


        foreach ($data['questions'] as $question) {
            $exam_questions[] = new ExamQuestion([
                'user_id' => Auth::id() , 
                'exam_id' => $exam->id, 
                'question_id' => $question , 
            ]);
        }
        $exam->questions()->saveMany($exam_questions);


        if (array_key_exists('students', $data)) {
            
            foreach ($data['students'] as $student_id) {
                $student_exam = new StudentExam;
                $student_exam->student_id = $student_id;
                $student_exam->exam_id = $exam->id;
                $student_exam->started_at = null;
                $student_exam->ended_at = null;
                $student_exam->total_degree = 0;
                $student_exam->is_finished = 0;
                $student_exam->save();
            }
        }

    }

}
