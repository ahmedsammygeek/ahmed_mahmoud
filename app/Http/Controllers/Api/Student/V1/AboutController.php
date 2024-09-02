<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
class AboutController extends Controller
{

    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->hasHeader('lang')) {
            if ($request->header('lang') == 'ar' ) {
                $data['about_us'] = 'ابليكيشن تعليمي مهتم بكل ما يخص العمليه التعليميه في كل مراحل العمر والتواصل مع الطلاب ف كل مراحل حياتهم وهذا الابليكيشن يعتبر ملكيه خاصه لا يجوز عرض المحتوي الخاص بيه علي العامه دون اذن او موافقه مسبقه من المسؤولين عنه 
للتواصل 
01020112626
';
            } else {
                $data['about_us'] = 'An educational application concerned with everything related to the educational process at all stages of life and communicating with students at all stages of their lives. This application is considered a private property, and its content may not be displayed to the public without permission or prior approval from those responsible for it. 
Contact 01020112626';
            } 
        } else {
            $data['about_us'] = 'An educational application concerned with everything related to the educational process at all stages of life and communicating with students at all stages of their lives. This application is considered a private property, and its content may not be displayed to the public without permission or prior approval from those responsible for it. 
Contact 01020112626';
        }




        return $this->response(
            data : $data , 
        );
    }

}
