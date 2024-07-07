<?php

namespace App\Livewire\Board\Groups;

use Livewire\Component;
use App\Models\{Course , Group };

use Livewire\Attributes\Computed;
use Livewire\Attributes\On; 
class AddNewGroup extends Component
{

    public $course_id;
    public $group_days = 1 ;
    public $days = [];
    public $from = [];
    public $to = [];

    public function addMoreDays()
    {
        $this->group_days++;
    }

    #[On('removeRow')]
    public function remove()
    {
        $this->group_days--;
    }

    public function save()
    {
        $groups = Group::where('course_id' , $this->course_id )->get();

        dd($courses);
        sleep(4);    
    }

    public function render()
    {
        $courses = Course::select('id' , 'title' )->get();
        return view('livewire.board.groups.add-new-group' , compact('courses') );
    }
}
