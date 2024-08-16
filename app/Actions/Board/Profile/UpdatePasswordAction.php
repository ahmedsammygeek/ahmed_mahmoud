<?php

namespace App\Actions\Board\Profile;
use Hash;
use Auth;

class UpdatePasswordAction
{
    


    public function handle($data)
    {
        $user = Auth::user();
        $user->password = $data['password'];
        $user->save();

        return true;
    }
}
