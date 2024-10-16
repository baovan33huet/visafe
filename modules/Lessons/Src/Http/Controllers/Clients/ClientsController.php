<?php
namespace Modules\Lessons\Src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Modules\Courses\Src\Repositories\CoursesRepositoryInterface;
use Modules\Lessons\Src\Repositories\LessonsRepository;
use Illuminate\Http\Request;

class ClientsController extends Controller {

    protected $coursesRepository;
    protected $lessonRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository, LessonsRepository $lessonsRepository) {
        $this->coursesRepository = $coursesRepository;
        $this->lessonRepository  = $lessonsRepository;
    }

    public function index($slug) {
        $lesson = $this->lessonRepository->getLessonClient($slug);
        if (!$lesson) {
            abort(404);
        }


        $course = $lesson->course;

        $currentLesson = null;
        $lessons = $this->lessonRepository->getLessonByPosition($course);
        foreach ($lessons as $key => $item) {
            if ($item->id == $lesson->id) {
                $currentLesson = $key;
                break;
            }
        }

        $nextLesson = null;
        $prevLesson = null;

        if ( isset($lessons[$currentLesson + 1]) ) {
            $nextLesson = $lessons[$currentLesson + 1];
        }

        if ( isset($lessons[$currentLesson - 1]) ) {
            $prevLesson = $lessons[$currentLesson - 1];
        }
        $pageTitle = $lesson->name;
        $pageName  = $lesson->name;
        return view('lessons::clients.index', compact('pageTitle', 'pageName', 'lesson', 'course', 'nextLesson', 'prevLesson'));
    }


}
