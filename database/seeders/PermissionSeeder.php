<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = ["add new admin","list all admins","show all admins","edit admin details","delete admin","add new slide","show slides details","list all slides","edit slide details","delete slide","add new university","show university details","list all universities","edit university details","delete university","add new faculty","show faculty details","list all faculties","edit faculty details","delete faculty","add new faculty level","show faculty level details","list all faculty_levels","edit faculty level details","delete faculty level","add new teacher","show teacher details","list all teachers","edit teacher details","delete teacher","add new grade","show grade details","list all grades","edit grade details","delete grade","add new educational system","add new course","show course details","list all courses","edit course details","delete course","add new video","show video details","list all videos","edit video details","delete video","add new lesson","show lesson details","list all lessons","edit lesson details","delete lesson","add new unit","show unit details","list all units","edit unit details","delete unit","add new student","show student details","list all students","edit student details","delete student","add new group","show group details","list all groups","edit group details","delete group","add new question","show question details","list all questions","edit question details","delete question","add new exam","show exam details","list all exams","edit exam details","delete exam","add new announcement","show announcement details","list all announcements","edit announcement details","delete announcement" , 'edit settings' ,
        'add course to student' , 
        'disable course for student' , 
        'delete course from student' , 
        'manipluate student device' , 
        'manipluate student course views' , 
        'add new file to library' , 
        'add student to library' , 
        'remove students from courses'
    ];




    foreach ($permissions as $permission) {
        $save_permission =  Permission::firstOrCreate([
            'name' => $permission,
            'guard_name' => 'web',
        ]);
    }
}
}
