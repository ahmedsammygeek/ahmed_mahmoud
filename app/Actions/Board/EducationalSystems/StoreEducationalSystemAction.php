<?php

namespace App\Actions\Board\EducationalSystems;
use Auth;
use App\Models\EducationalSystem;
class StoreEducationalSystemAction
{
    

   public function execute($data)
   {
       $system = new EducationalSystem;
       $system->setTranslation('name' , 'ar' , $data['name_ar'] );
       $system->setTranslation('name' , 'en' , $data['name_en'] );
       $system->user_id = Auth::id();
       $system->is_active = array_key_exists('active', $data) ? 1 : 0;
       $system->save();
   }
}
