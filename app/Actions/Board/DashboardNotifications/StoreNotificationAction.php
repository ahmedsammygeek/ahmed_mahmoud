<?php

namespace App\Actions\Board\DashboardNotifications;

use App\Models\DashboardNotification;
use Auth;
class StoreNotificationAction
{
    
    public function execute( $data)
    {
        $notification = new DashboardNotification;
        $notification->setTranslation('title' , 'ar' , $data['title_ar'] );
        $notification->setTranslation('title' , 'en' , $data['title_en'] );
        $notification->setTranslation('content' , 'ar' , $data['content_ar'] );
        $notification->setTranslation('content' , 'en' , $data['content_en'] );
        $notification->user_id = Auth::id();
        $notification->save(); 
        return true;
    }

}
