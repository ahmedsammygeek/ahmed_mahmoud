<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Storage;
class NewFileAddedNotification extends Notification
{
    use Queueable;
    public $lesson_file;
    /**
     * Create a new notification instance.
     */
    public function __construct($lesson_file)
    {
        $this->lesson_file = $lesson_file;
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
            'content' => 'تم اضافه ملف جديد داخل الكورس : '.$this->lesson_file?->lesson?->unit?->course?->title , 
            'type' => 'new_file' ,
            'course_id' => $this->lesson_file?->lesson?->unit?->course_id , 
            'lesson_id' => $this->lesson_file->lesson_id , 
            'video_id' => $this->lesson_file?->video_id , 
            'file_id' => $this->lesson_file->id , 
            'exam_id' => null , 
            'image' => Storage::url('notifications/notifications.webp') , 
        ];
    }
}
