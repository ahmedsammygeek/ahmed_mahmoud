<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Http\Requests\Board\Profile\UpdatePasswordRequest;
use App\Actions\Board\Profile\UpdatePasswordAction;
class PasswordController extends Controller
{
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('board.password.edit');
    }



    public function update(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error' , trans('profile.current password is wrong') );
        }

        $action = new  UpdatePasswordAction; 

        $action->handle($request->all());
        return redirect()->back()->with('success' , trans('profile.password updated successfully') );

    }




}
