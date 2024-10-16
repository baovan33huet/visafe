<?php
namespace Modules\Students\Src\Http\Middlewares;

use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class StudentsMiddleware {
    public  function  handle(Request $request, Closure $next) {
        $studentRepository = new \Modules\Students\Src\Repositories\StudentsRepository();
        $studentId = Auth::guard('students')->id();

        $slugCourse = $request->slug;
        $listCourses = [];
        $courses = $studentRepository->getAllCoursesOfStudent($studentId);
        foreach ($courses as $course) {
            $lessons = $course->lessons()->get();
            foreach ($lessons as $lesson)
            array_push($listCourses, $lesson->slug);
        }

        $checkLesson = in_array($slugCourse, $listCourses);
        if (!$checkLesson) {
            return redirect()->route('client.checkCourse');
        }
        return $next($request);
    }
}
