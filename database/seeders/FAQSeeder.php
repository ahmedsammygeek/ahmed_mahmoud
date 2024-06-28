<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FAQ;
class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        



        for ($i=0; $i < 6; $i++) { 
            $faq = new FAQ;
            $faq->setTranslation('title' , 'ar' , 'السؤال رقم '.$i );
            $faq->setTranslation('title' , 'en' , 'question number '.$i );
            $faq->setTranslation('content' , 'ar' , 'وعند موافقه العميل المبدئيه على التصميم يتم ازالة هذا النص من التصميم ويتم وضع النصوص النهائية المطلوبة للتصميم ويقول البعض ان وضع النصوص التجريبية بالتصميم قد تشغل المشاهد عن وضع الكثير من الملاحظات او الانتقادات للتصميم الاساسي.' );
            $faq->setTranslation('content' , 'en' , 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo' );
            $faq->user_id = 1;
            $faq->is_active = 1;
            $faq->save();
        }

    }
}
