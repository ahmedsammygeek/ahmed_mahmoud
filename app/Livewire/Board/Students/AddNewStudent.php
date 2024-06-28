<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use App\Models\{Grade , EducationalSystem  };
class AddNewStudent extends Component
{   

    public $student_type = false;


    public function mount()
    {
        if (old('student_type')) {
            $this->student_type = old('student_type') ;
        }
    }

    public function render()
    {
        $grades = Grade::select('id' , 'name' )->get();
        $systems = EducationalSystem::select('id' , 'name' )->get();
        return view('livewire.board.students.add-new-student'  , compact('grades' , 'systems' )  );
    }
}
