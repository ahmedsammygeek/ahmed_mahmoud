<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            PermissionSeeder::class , 
            // EducationalSystemSeeder::class , 
            // CourseSeeder::class , 
            // GradeSeeder::class ,
            // UnitSeeder::class , 
            // UnitLessonSeeder::class ,  
            // QuestionSeeder::class , 
            // QuestionAnswerSeeder::class , 
            // SplashSeeder::class , 
            // FAQSeeder::class , 
            // UniversitySeeder::class , 
            // FacultySeeder::class
            // AnnouncementSeeder::class, 
        ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
