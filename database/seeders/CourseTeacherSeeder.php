<?php

namespace Database\Seeders;

use App\Models\CourseTeacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseTeacher::query()->create([
            'course_id'=>1,
            'teacher_id'=>2
        ]);
        CourseTeacher::query()->create([
            'course_id'=>1,
            'teacher_id'=>3
        ]);
        CourseTeacher::query()->create([
            'course_id'=>2,
            'teacher_id'=>2
        ]);
        CourseTeacher::query()->create([
            'course_id'=>3,
            'teacher_id'=>4
        ]);
    }
}
