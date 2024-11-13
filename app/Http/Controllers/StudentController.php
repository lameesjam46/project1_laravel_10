<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseTeacher;
use App\Models\CourseTeacherStudent;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $students =Student::query()->get();
        foreach ($students as $student){
            $student_courses[]= Student::query()
                ->with('course_teacher_student','course_teacher_student.course_teacher',
                'course_teacher_student.course_teacher.teacher','course_teacher_student.course_teacher.course')
                ->find($student['id']);

        }
        return response()->json([
            'status'=>1,
            'data'=>$student_courses,
            'MSG'=>'student index successfully'
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name'=>['required','unique:students,name'],
            'student_courses'=>['array','present'],
            'student_courses.*.teacher'=>['required'],
            'student_courses.*.course'=>['required'],

        ]);
        $student=Student::query()->create(['name'=>$request['name']]);
        $student_courses=[];

        foreach ($request['student_courses'] as $student_course) {
            $teacher_name = $student_course['teacher'];
            $course_name = $student_course['course'];

            // create teacher if not exit
            $teacher = Teacher::query()->where('name', '=', $teacher_name)->first();
            if (is_null($teacher)) {
                $teacher = Teacher::query()->create(['name' => $teacher_name]);
            }


            // create course if not exit
            $course = Course::query()->where('title', '=', $course_name)->first();
            if (is_null($course)) {
                $teacher = Course::query()->create(['title' => $course_name]);
            }

            // link teacher to course if not exit
            $coure_teacher = CourseTeacher::query()
                ->where('course_id', '=', $course['id'])
                ->where('teacher_id', '=', $teacher['id'])->first();
            if (is_null($coure_teacher)) {
                CourseTeacher::query()->create([
                    'course_id' => $course['id'],
                    'teacher_id' => $teacher['id']]);
            }

            //
            $student_course = CourseTeacherStudent::query()->create([
                'student_id' => $student['id'],
                'course_teacher_id' => $coure_teacher['id']
            ]);

            $student_courses[] = CourseTeacherStudent::query()
                ->select('id','student_id','course_teacher_id')
                ->with(['course_teacher:id,course_id,teacher_id', 'student:id,name', 'course_teacher.course:id,title', 'course_teacher.teacher:id,name'])
                ->find($student_course['id']);
        }

        return response()->json([
            'status'=>1,
            'data'=>$student_courses,
            'MSG'=>'student store successfully'
        ]);
    }

    public function update(Request $request,$id): JsonResponse
    {
        $request->validate([
            'student_courses'=>['array','present'],
            'student_courses.*.teacher'=>['required'],
            'student_courses.*.course'=>['required'],

        ]);
        $student=Student::query()->find($id);
        $student->course_teacher_student()->delete();

        foreach ($request['student_courses'] as $student_course) {
            $teacher_name = $student_course['teacher'];
            $course_name = $student_course['course'];

            // create teacher if not exit
            $teacher = Teacher::query()->where('name', '=', $teacher_name)->first();
            if (is_null($teacher)) {
                $teacher = Teacher::query()->create(['name' => $teacher_name]);
            }


            // create course if not exit
            $course = Course::query()->where('title', '=', $course_name)->first();
            if (is_null($course)) {
                $teacher = Course::query()->create(['title' => $course_name]);
            }

            // link teacher to course if not exit
            $coure_teacher = CourseTeacher::query()
                ->where('course_id', '=', $course['id'])
                ->where('teacher_id', '=', $teacher['id'])->first();
            if (is_null($coure_teacher)) {
                CourseTeacher::query()->create([
                    'course_id' => $course['id'],
                    'teacher_id' => $teacher['id']]);
            }

            //
            $student_course = CourseTeacherStudent::query()->create([
                'student_id' => $student['id'],
                'course_teacher_id' => $coure_teacher['id']
            ]);

            $student_courses[] = CourseTeacherStudent::query()
                ->select('id','student_id','course_teacher_id')
                ->with(['course_teacher:id,course_id,teacher_id', 'student:id,name', 'course_teacher.course:id,title', 'course_teacher.teacher:id,name'])
                ->find($student_course['id']);
        }

        return response()->json([
            'status'=>1,
            'data'=>$student_courses,
            'MSG'=>'student updated successfully'
        ]);
    }

}
