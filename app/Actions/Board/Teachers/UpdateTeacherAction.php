<?php

namespace App\Actions\Board\Teachers;

use App\Models\Teacher;
use App\Models\User;
use Auth;
use Hash;
use Spatie\Permission\Models\Permission;

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
        $teacher->force_face_detecting = array_key_exists('force_face_detecting', $data) ? 1 : 0 ;
        $teacher->speak_user_phone = array_key_exists('speak_user_phone', $data) ? 1 : 0 ;
        $teacher->show_phone_on_viedo = array_key_exists('show_phone_on_viedo', $data) ? 1 : 0 ;
        $teacher->force_headphones = array_key_exists('force_headphones', $data) ? 1 : 0 ;
        if (array_key_exists('image' , $data )) {
            $teacher->image = basename($data['image']->store('teachers'));
        }
        $teacher->save();

        $user = User::find($teacher->id);
        $user->permissions()->detach();
        if (array_key_exists('permissions', $data)) {
            $user->syncPermissions($data['permissions']);
        }

    }
}
