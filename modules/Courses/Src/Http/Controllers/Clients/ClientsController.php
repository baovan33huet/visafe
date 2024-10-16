<?php
namespace Modules\Courses\Src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Modules\Courses\Src\Repositories\CoursesRepositoryInterface;
use Modules\Lessons\Src\Repositories\LessonsRepository;
use Illuminate\Http\Request;
use Iman\Streamer\VideoStreamer;

class ClientsController extends Controller {

    protected $coursesRepository;
    protected $lessonRepository;

   public function __construct(CoursesRepositoryInterface $coursesRepository, LessonsRepository $lessonsRepository) {
    $this->coursesRepository = $coursesRepository;
    $this->lessonRepository  = $lessonsRepository;
   }

   public function index() {
       $pageTitle = 'Khoá học';
       $pageName  = 'Khoá học';
       $limit = config('paginate.limit');
       $courses = $this->coursesRepository->getCourses($limit);
       return view('courses::clients.index', compact('pageTitle', 'pageName', 'courses'));
   }

   public function detail($slug) {
       $course = $this->coursesRepository->getCourseClientDetail($slug);
       $allCourses = $this->coursesRepository->getAll();
       if (!$course) {
           abort(404);
       }
       $pageTitle = $course->name;
       $pageName  = $course->name;
       return view('courses::clients.detail', compact('pageTitle', 'pageName', 'allCourses', 'course'));
   }

   public function getTrialLesson($lessonId = 0) {
       $lesson = $this->lessonRepository->find($lessonId);

       if (!$lesson) {
           return [
               'success' => false,
           ];
       }

       $lesson->video;
       return [
           'success' => true,
           'data'   => $lesson
       ];
   }

   public function streamVideo(Request $request) {
        $videoUrl = $request->video;
        $path = public_path($videoUrl);
        VideoStreamer::streamFile($path);

   }
}
