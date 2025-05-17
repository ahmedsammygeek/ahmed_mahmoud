<?php

namespace App\Livewire\Board\Announcements;

use Livewire\Component;
use App\Models\{Course  , Announcement  , Student};

use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On; 
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Carbon\Carbon;
use Auth;
class AddNewAnnouncement extends Component
{

    use WithPagination , WithFileUploads;

    public $course_id;
    public $selected_students = [];
    public $search;
    public $type;
    public $publish_for;
    public $title_ar;
    public $title_en;
    public $content_ar;
    public $content_en;
    public $image;


    #[Computed]
    public function students()
    {
        return Student::query()
        ->when($this->course_id , function($query){
            $query->whereHas('courses' , function($query){
                $query->where('course_id' , $this->course_id  );
            });
        })
        ->when($this->search , function($query){
            $query
            ->where('name' , 'LIKE' , '%'.$this->search.'%' )
            ->orWhere('mobile' ,  'LIKE' , '%'.$this->search.'%'  )
            ->orWhere('guardian_mobile' ,  'LIKE' , '%'.$this->search.'%' );
        })
        ->paginate(10);
    }



    public function save()
    {
        // dd($this->type);
        $validated = $this->validate([ 
            'type' => 'required',
            'title_ar' => 'required',
            'title_en' => 'required',
            'image' => 'required_if:type,1' , 
            'content_ar' => 'required_if:type,2' ,
            'content_en' => 'required_if:type,2' ,
            'publish_for' => 'required' ,  
        ]);

        // $this->validate();
        $announcement = new Announcement;
        $announcement->type = $this->type;
        $announcement->publish_for = $this->publish_for;
        $announcement
        ->setTranslation('title', 'ar', $this->title_ar)
        ->setTranslation('title', 'en', $this->title_en);
        if ($this->type == 2) {
            $image = basename($this->image->store('announcements'));
            $announcement
            ->setTranslation('content', 'ar', $image)
            ->setTranslation('content', 'en', $image);
        }

        if ($this->type == 1) {
            $announcement
            ->setTranslation('content', 'ar', $this->content_ar)
            ->setTranslation('content', 'en', $this->content_en);
        }

        $announcement->user_id = Auth::id();
        $announcement->is_active  = 1;
        $announcement->save();

        $this->dispatch('added');

        $this->course_id  = null;
        $this->search  = null;
        $this->title_ar  = null;
        $this->title_ar  = null;
        $this->type  = null;
        $this->image  = null;
        $this->content_ar  = null;
        $this->content_en  = null;
        $this->publish_for  = null;


    }

    public function render()
    {

        $courses = Course::select('id' , 'title' )->get();
        return view('livewire.board.announcements.add-new-announcement' , compact('courses') );
    }
}
