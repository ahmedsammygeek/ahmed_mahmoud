<?php

namespace App\Actions\Board\Teachers;

use App\Models\Teacher;
use Auth;
use Hash;
class UpdateTeacherAction
{
    public function handle( $teacher ,  $data)
    {

        if (array_key_exists('password' , $data )) {
            $teacher->password = Hash::make($data['password']);
        }
        $teacher->name = $data['name'];
        $teacher->mobile = $data['mobile'];
        $teacher->bio = $data['bio'];
        $teacher->default_views_number = $data['default_views_number'];
        $teacher->show_in_suggested_in_app = array_key_exists('show_in_suggested_in_app', $data) ? 1 : 0 ;
        if (array_key_exists('image' , $data )) {
            $teacher->image = basename($data['image']->store('teachers'));
        }
        $teacher->save();
    }
}
