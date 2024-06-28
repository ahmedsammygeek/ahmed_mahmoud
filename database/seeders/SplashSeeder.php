<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Splash;
class SplashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $Splash = new Splash;
        $Splash->setTranslation('content' , 'ar' , 'مرحبا بك فى تطبيق استاذ احمد محمود' );
        $Splash->setTranslation('content' , 'en' , 'wellcome in mr ahmed mahmoud application' );
        $Splash->image = 'dsd';
        $Splash->user_id = 1;
        $Splash->is_active = 1;
        $Splash->save();




        $Splash = new Splash;
        $Splash->setTranslation('content' , 'ar' , 'يمكنك التعلم بهسوله عبر الكورسات المتنوعه المتاحه' );
        $Splash->setTranslation('content' , 'en' , 'you can purchase any course you like' );
        $Splash->image = 'dsd';
        $Splash->user_id = 1;
        $Splash->is_active = 1;
        $Splash->save();

        
    }
}
