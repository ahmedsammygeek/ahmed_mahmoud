<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Http\Resources\Api\Students\V1\Notifications\NotificationResource;
use App\Traits\Api\GeneralResponse;
class NotificationController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();
        $data['notifications'] = NotificationResource::collection($student->notifications()->latest()->get());

        return $this->response(
            data : $data
        );
    }


    public function read()
    {
        $student = Auth::guard('student')->user();
       
        foreach ($student->notifications as $notification) {
            $notification->read_at = Carbon::now();
            $notification->save();
        }

        return $this->response(
            message : 'all notifications marked as read successfully' , 
        );
    }

}
