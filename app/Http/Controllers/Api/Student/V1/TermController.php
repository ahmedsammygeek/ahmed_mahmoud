<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
class TermController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data['terms'] = 'ممنوع عمل اسكرين ريكورد او التصوير او تسجيل المحتوي التعليمي ممنوع نشر المحتوي الخاص بالابليكيشن ف اي مكان خارج الابليكيشن والا يعتبر سرقه للمحتوي 
الاحكام ف حاله التجاوز :
يحق للابليكيشن ايقاف اي اكونت بدون الرجوع لصاحب الاكونت وف حاله استمرار التجاوز يحق للابليكيشن الدفاع عن حقوقه بما يشمل المساءله القانونيه ضد الشخص المنتهك لتلك الحقوق الخاصه بالمحتوي بصفه خاصه او الابليكيشن بصفه عامه';

        return $this->response(
            data : $data , 
        );
    }

}
