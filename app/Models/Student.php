<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function course_teacher_student():HasMany
    {
        return $this->hasMany(CourseTeacherStudent::class);
    }
}
