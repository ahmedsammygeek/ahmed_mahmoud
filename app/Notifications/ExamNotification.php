<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Storage;
class ExamNotification extends Notification
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
            'content' => 'تم انشاء اخبترا جديد برجاء الانتهاء منه' , 
            'type' => 'exam' ,
            'course_id' => null , 
            'exam_id' => 17 , 
            'lesson_id' => null , 
            'video_id' => null ,
            'image' => Storage::url('notifications/notifications.webp') , 
        ];
    }
}