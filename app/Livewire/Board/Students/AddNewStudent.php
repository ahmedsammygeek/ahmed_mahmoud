<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use App\Models\{Grade , EducationalSystem  };
class AddNewStudent extends Component
{   

    public $student_type = false;
    public $grade;
    public $educational_system_id;
    public $name;
    public $mobile;
    public $guardian_mobile;


    public function mount()
    {
        if (old('student_type')) {
            $this->student_type = old('student_type') ;
        }
        if (old('grade')) {
            $this->grade = old('grade') ;
        }
        if (old('educational_system_id')) {
            $this->educational_system_id = old('educational_system_id') ;
        }
        if (old('name')) {
            $this->name = old('name') ;
        }
        if (old('mobile')) {
            $this->mobile = old('mobile') ;
        }
        if (old('guardian_mobile')) {
            $this->guardian_mobile = old('guardian_mobile') ;
        }
    }

    public function render()
    {
        $grades = Grade::select('id' , 'name' )->get();
        $systems = EducationalSystem::select('id' , 'name' )->get();
        return view('livewire.board.students.add-new-student'  , compact('grades' , 'systems' )  );
    }
}
