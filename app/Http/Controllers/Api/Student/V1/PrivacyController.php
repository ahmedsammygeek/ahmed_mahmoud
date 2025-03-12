<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
class PrivacyController extends Controller
{
     use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['privacy'] = '<pre>ابلكيشن تعليمي لا يجوز تداول المحتوي الخاص بيه خارج الابلكيشن 
والا يحق للابلكيشن القيام بكل وسائل
الدفاع عن حقوقه بما فيها المسائله القانونيه

        </pre>';

        return $this->response(
            data : $data , 
        );
    }

}
