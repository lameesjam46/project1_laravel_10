<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::query()->create([
            'title'=>'php'
        ]);
        Course::query()->create([
            'title'=>'html'
        ]);
        Course::query()->create([
            'title'=>'laravel'
        ]);
        Course::query()->create([
            'title'=>'english'
        ]);
    }
}
