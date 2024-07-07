<?php

namespace App\Actions\Board\Groups;
use App\Models\{Group  ,GroupTime};
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
class StoreGroupAction
{



    public function execute($data)
    {
        $group = new Group;
        $group->user_id = Auth::id();
        $group->name = $data['name'];
        $group->max_students_limit  = $data['maxmimam'];
        $group->course_id = $data['course_id'];
        $group->starts_at = $data['starts_at'];
        $group->ends_at = $data['ends_at'];
        $group->save();

        $dates = [];
        $group_times = [];

        for ($i=0; $i <count($data['days']) ; $i++) { 
            $period = CarbonPeriod::between( $group->starts_at , $group->ends_at )
            ->filter(fn ($date) => $date->is($data['days'][$i]));
            foreach ($period as $date) {
                $date_from = clone$date; 
                $date_to = clone$date; 
                $date_from_with_time = $date_from->setTimeFromTimeString($data['from'][$i]);
                $date_to_with_time = $date_to->setTimeFromTimeString($data['to'][$i]);

                $group_times[] = new GroupTime([
                    'user_id' => Auth::id() , 
                    'course_teacher_group_id' => $group->id , 
                    'time_from' => $date_from_with_time->toDateTimeString() , 
                    'time_to' =>  $date_to_with_time->toDateTimeString()
                ]);

            }
        }

        $group->times()->saveMany($group_times);
    }
}
