<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement;
class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Announcement = new Announcement;
        $Announcement->user_id = 1;
        $Announcement->is_active = 1;
        $Announcement->setTranslation('title' , 'ar' , 'تنبيه هام' );
        $Announcement->setTranslation('title' , 'en' , 'important note' );
        $Announcement->setTranslation('content' , 'ar' , 'هنا يتم وضع فتاصيل النصى للاعلان المراض عرضه' );
        $Announcement->setTranslation('content' , 'en' , 'here we put the announcement text we want it' );
        $Announcement->type = 1;
        $Announcement->save();
        $Announcement = new Announcement;
        $Announcement->user_id = 1;
        $Announcement->is_active = 1;
        $Announcement->setTranslation('title' , 'ar' , 'تنبيه هام' );
        $Announcement->setTranslation('title' , 'en' , 'important note' );
        $Announcement->setTranslation('content' , 'ar' , 'announcement.png' );
        $Announcement->setTranslation('content' , 'en' , 'announcement.png' );
        $Announcement->type = 1;
        $Announcement->save();
    }
}
