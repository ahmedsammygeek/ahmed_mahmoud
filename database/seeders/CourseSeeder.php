<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [

            [ 'كمياء' , 'chemistry' ] , 
            ['رياصيات 2' , 'Math 2'] , 
            ['فيزياء' , 'Physics'] , 
            ['اللغه الانجليزيه' , 'English'] , 
            ['اللغه العربيه' , 'Arabic'] , 

        ];

        $content = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

        $ar_content = 'ذلك بالفشل ونستون ابتدعها قد. لها قد مساعدة الحلفاء, واشتدّت الهزائم إلى كل. تم البلطيق الحيلولة دار, عن به، تُصب البرية والحلفاء. مشارف واشتدّت شبح كل, بتخصيص بل مما. الحرة بقيادة تم وصل.

        لغزو احتار كل أسر, بـ هُزم النمسا الخاسر بعد, من مسرح ألمانيا البشريةً فعل. والجنوب ارتكبها وبالتحديد، فعل. الا مع قِبل أمدها جديداً. بوابة الضغوط أن ولم. قد لمّ مكثّفة دنكيرك. جهة وبعض شعار ان.

        بحق نهاية تكاليف بريطانيا، ما, إلى أن النزاع الألماني. حرب غزوه أصقاع القوقازية تم, حتى كل ألماني بقيادة والكوري, بلا أجزاء مواقعها بل. عدد عقبت بالسيطرة عل. دول معقل لهذه أسابيع. أن وقد وباءت المجتمع, هجوم وبغطاء ذلك هو. تعديل فهرست.';

        for ($i=0; $i <count($courses) ; $i++) { 
            $one_course = new Course;
            $one_course
            ->setTranslation('title', 'ar', $courses[$i][0] )
            ->setTranslation('title', 'en', $courses[$i][1])
            ->setTranslation('content', 'ar', $content)
            ->setTranslation('content', 'en', $ar_content );
            $one_course->user_id = 1;
            $one_course->price = mt_rand(350 , 1300) ;
            $one_course->grade = mt_rand(10 , 13) ;
            $one_course->user_id = 1;
            $one_course->is_active = 1;
            $one_course->image = 'course1.png' ;
            $one_course->save();
        }



    }
}
