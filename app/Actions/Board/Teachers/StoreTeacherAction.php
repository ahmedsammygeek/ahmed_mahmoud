<?php

namespace App\Actions\Board\Teachers;

use App\Models\Teacher;
use Auth;
use Hash;
class StoreTeacherAction
{
    


    public function handle($data)
    {
        $teacher = new Teacher;
        $teacher->password = Hash::make($data['password']);
        $teacher->name = $data['name'];
        $teacher->mobile = $data['mobile'];
        $teacher->bio = $data['bio'];
        $teacher->default_views_number = $data['default_views_number'];
        $teacher->show_in_suggested_in_app = array_key_exists('show_in_suggested_in_app', $data) ? 1 : 0 ;
        $teacher->force_face_detecting = array_key_exists('force_face_detecting', $data) ? 1 : 0 ;
        $teacher->speak_user_phone = array_key_exists('speak_user_phone', $data) ? 1 : 0 ;
        $teacher->show_phone_on_viedo = array_key_exists('show_phone_on_viedo', $data) ? 1 : 0 ;
        $teacher->force_headphones = array_key_exists('force_headphones', $data) ? 1 : 0 ;
        $teacher->force_water_mark = array_key_exists('force_water_mark', $data) ? 1 : 0 ;
        $teacher->allow_download = array_key_exists('allow_download', $data) ? 1 : 0 ;
        $teacher->default_library_views_number = $data['default_library_views_number'];
        $teacher->default_library_download_number = $data['default_library_download_number'];
        $teacher->image = basename($data['image']->store('teachers'));
        $teacher->type = 2;
        $teacher->is_banned = 0;
        $teacher->user_id = Auth::id();
        $teacher->save();
    }
}
