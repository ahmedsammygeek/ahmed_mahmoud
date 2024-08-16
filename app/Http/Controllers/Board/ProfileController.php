<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Http\Requests\Board\Profile\UpdateProfileRequest;
use App\Actions\Board\Profile\UpdateProfileAction;
class ProfileController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('board.profile.edit' , compact('user') );
    }


    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error' , trans('profile.current password is wrong') );
        }

        $action = new  UpdateProfileAction; 

        $action->handle($request->all());
        return redirect()->back()->with('success' , trans('profile.profile updated successfully') );
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('board.index'))->with('success' , trans('profile.logged out successfully') );
    }

}
