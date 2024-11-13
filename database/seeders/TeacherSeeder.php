<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::query()->create([
            'name'=>'lamees'
        ]);
        Teacher::query()->create([
            'name'=>'kalhed'
        ]);
        Teacher::query()->create([
            'name'=>'osama'
        ]);
        Teacher::query()->create([
            'name'=>'fatema'
        ]);
    }
}
