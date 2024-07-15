<?php

namespace App\Actions\Board\EducationalSystems;

class UpdateEducationalSystemAction
{


    public function execute( $system , $data)
    {
        $system->setTranslation('name' , 'ar' , $data['name_ar'] );
        $system->setTranslation('name' , 'en' , $data['name_en'] );
        $system->is_active = array_key_exists('active', $data) ? 1 : 0;
        $system->save();
    }
}
