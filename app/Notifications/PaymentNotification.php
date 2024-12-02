<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Storage;
class PaymentNotification extends Notification
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
            'content' => 'يجب تسديد المبلغ امتبقى لمضان عدم اغلاق الكورس ' , 
            'type' => 'payment' ,
            'course_id' => 17 , 
            'exam_id' => null , 
            'lesson_id' => null , 
            'video_id' => null ,
            'image' => Storage::url('notifications/notifications.webp') , 
        ];
    }
}
