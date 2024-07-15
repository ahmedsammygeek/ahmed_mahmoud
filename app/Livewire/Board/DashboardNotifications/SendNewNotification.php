<?php

namespace App\Livewire\Board\DashboardNotifications;

use Livewire\Component;
use App\Models\{Course , Grade , Student };

use Livewire\Attributes\Computed;
class SendNewNotification extends Component
{   

    public $grade_id;
    public $course_id;
    public $selected_students;

    #[Computed]
    public function courses()
    {
        return Course::where('grade_id' , $this->grade_id )->get();
    }

    #[Computed]
    public function students()
    {
        return Student::select('id' , 'name' , 'mobile' )->get();
    }

    public function render()
    {
        $grades = Grade::select('id' , 'name' )->get();
        return view('livewire.board.dashboard-notifications.send-new-notification' , compact('grades') );
    }
}
