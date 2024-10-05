<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\University;
class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $University = new University;
        $University->setTranslation('name' , 'ar' , 'جامعه المنصوره' );
        $University->setTranslation('name' , 'en' , 'Mansoura University' );
        $University->user_id = 1;
        $University->is_active = 1;
        $University->save();


        $University = new University;
        $University->setTranslation('name' , 'ar' , 'جامعه الدلتا' );
        $University->setTranslation('name' , 'en' , 'Delta University' );
        $University->user_id = 1;
        $University->is_active = 1;
        $University->save();


        $University = new University;
        $University->setTranslation('name' , 'ar' , 'جامعه حورس' );
        $University->setTranslation('name' , 'en' , 'Hours University' );
        $University->user_id = 1;
        $University->is_active = 1;
        $University->save();



        $University = new University;
        $University->setTranslation('name' , 'ar' , 'جامعه طنطا' );
        $University->setTranslation('name' , 'en' , 'Tanta University' );
        $University->user_id = 1;
        $University->is_active = 1;
        $University->save();
    }
}
