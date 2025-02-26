<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Storage;
class NewVideoAddedNotification extends Notification
{
    use Queueable;
    public $video;

    /**
     * Create a new notification instance.
     */
    public function __construct($video)
    {
        $this->video = $video;
        $this->video->load('lesson.unit.course');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
       return [
            'content' => 'a new video has been  added to your course , course name' , 
            'content' => 'تم اضافه فديو جديد داخل الكورس : '.$this->video?->lesson?->unit?->course?->title , 
            'type' => 'new_video' ,
            'course_id' => $this->video?->lesson?->unit?->course_id , 
            'lesson_id' => $this->video->lesson_id , 
            'video_id' => $this->video->id , 
            'exam_id' => null , 
            'image' => Storage::url('notifications/notifications.webp') , 
        ];
    }
}
