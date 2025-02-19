<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\LoginRequest;
use Auth;
class AdminLoginController extends Controller
{
    public function form()
    {
        return view('board.login');
    }


    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('password' , 'mobile'))) {
            $request->session()->regenerate();
            return redirect(route('board.index'))->with('success' , 'تم تسجيل الدخول بنجاح' );
        }
        return back()->with('error' , 'كلمه المرور او البريك الاكترونى غير صحيحين' );
    }
}
