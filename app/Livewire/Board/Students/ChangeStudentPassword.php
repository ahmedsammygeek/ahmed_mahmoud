<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use Livewire\Attributes\On; 
use Livewire\Attributes\Validate;
use App\Models\Student;
class ChangeStudentPassword extends Component
{

    public $student;


    #[Validate('required|min:8|confirmed')] 
    public $password = '';
 
    #[Validate('required|min:8')] 
    public $password_confirmation = '';

    public function mount()
    {
        $this->student = new Student;
    }

    
    #[On('open-modal')] 
    public function openPaswordModal( int $student_id)
    {
        $this->student = Student::find($student_id);
    }

    public function save()
    {
        $this->validate();
        $this->student->password = $this->password;
        $this->student->save();

        $this->dispatch('passwordUpdated');
    }

    public function render()
    {
        return view('livewire.board.students.change-student-password');
    }
}
