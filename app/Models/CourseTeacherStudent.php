<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseTeacherStudent extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function course_teacher(): BelongsTo
    {
        return $this->belongsTo(CourseTeacher::class,'course_teacher_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }


}
