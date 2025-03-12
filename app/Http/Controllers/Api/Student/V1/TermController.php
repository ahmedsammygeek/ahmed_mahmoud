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
        
        $data['terms'] = '*ممنوع عمل اسكرين ريكورد أو التصوير أو تسجيل المحتوي التعليمي *ممنوع نشر المحتوي الخاص بالأبلكيشن ف اي مكان خارج الابلكيشن والا تعتبر سرقه للمحتوي الاحكام ف حاله التجاوز يحق للأبلكيشن إيقاف اي أكونت حتي دون التنبيه أو الرجوع لصاحب الاكونت ف مشاهده محتوي ما او حتي ايقاف الاكونت بالكامل من جميع محتويات الابلكيشن ف حاله الاستمرار والتجاوز ف انتهاك حقوق الابلكيشن بتصوير المحتوي بطرق غير شرعية يحق للأبلكيشن القيام بكل وسائل الدفاع عن حقوقه بما فيها المساءله القانونية ضد الشخص المنتهك للحقوق الخاصه بالمحتوي بصفه خاصه والأبلكيشن بصفه عامه';

        return $this->response(
            data : $data , 
        );
    }

}
