<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseTeacher extends Model
{
    use HasFactory;
    protected $guarded=[];
    /**
     * MY FK belong to
     */

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher():BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function course_teacher_student():HasMany
    {
        return $this->hasMany(CourseTeacherStudent::class);
    }
}
