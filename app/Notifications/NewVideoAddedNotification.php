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

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
            'type' => 'new_video' ,
            'course_id' => 17 , 
            'lesson_id' => 52 , 
            'video_id' => 103 , 
            'exam_id' => null , 
            'image' => Storage::url('notifications/notifications.webp') , 
        ];
    }
}
