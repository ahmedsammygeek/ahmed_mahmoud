<?php

namespace App\Actions\Board\Grades;
use App\Models\Grade;
class UpdateGradeAction
{
   
   public function execute( $grade ,  $data)
   {

       $grade->setTranslation('name' , 'ar' , $data['name_ar'] );
       $grade->setTranslation('name' , 'en' , $data['name_en'] );
       $grade->is_active = array_key_exists('active', $data) ? 1 : 0;
       $grade->save();
   }
}
