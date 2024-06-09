<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EducationalSystem;
class EducationalSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $systems = [
            ['system 1' , 'سستم 1'] , 
            ['system 2' , 'سستم 2'] , 
            ['system 3' , 'سستم 3'] , 
            ['system 4' , 'سستم 4'] , 
        ];


        for ($i=0; $i <count($systems) ; $i++) { 
            
            $EducationalSystem = new EducationalSystem;
            $EducationalSystem->setTranslation('name', 'ar' , $systems[$i][1] )
            ->setTranslation('name' , 'en' , $systems[$i][0] );
            $EducationalSystem->user_id = 1;
            $EducationalSystem->is_active = 1;
            $EducationalSystem->save();
        }
    }
}
