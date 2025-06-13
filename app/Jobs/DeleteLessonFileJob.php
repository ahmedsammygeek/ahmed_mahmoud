<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Storage;

use App\Models\LessonFile;
class DeleteLessonFileJob implements ShouldQueue
{
    use Queueable;

    public $lesson;

    /**
     * Create a new job instance.
     */
    public function __construct($lesson)
    {
        $this->lesson = $lesson;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $lesson_files = LessonFile::where('lesson_id' , $this->lesson->id )->get();
        foreach ($lesson_files as $lesson_file) {
            
            if (Storage::exists('lesson_files/'.$lesson_file->file)) {
                Storage::delete('lesson_files/'.$lesson_file->file);
            }
        }
    }
}
