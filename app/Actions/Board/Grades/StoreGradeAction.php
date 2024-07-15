<?php

namespace App\Actions\Board\Grades;
use Auth;
use App\Models\Grade;
class StoreGradeAction
{
   


   public function execute($data)
   {
       $grade = new Grade;
       $grade->setTranslation('name' , 'ar' , $data['name_ar'] );
       $grade->setTranslation('name' , 'en' , $data['name_en'] );
       $grade->user_id = Auth::id();
       $grade->is_active = array_key_exists('active', $data) ? 1 : 0;
       $grade->save();
   }
}
