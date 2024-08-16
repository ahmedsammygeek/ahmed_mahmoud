<?php

namespace App\Actions\Board\Profile;
use Auth;
use Hash;
class UpdateProfileAction
{
    


    public function handle($data)
    {
        $user = Auth::user();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->mobile = $data['mobile'];


        if ( array_key_exists('image', $data) && ($data['image'] != null) ) {
            $user->image = basename($data['image']->store('users'));
        }

        $user->save();

        return true;

    }


}
