<?php
namespace Modules\Lessons\Src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Courses\Src\Repositories\CoursesRepositoryInterface;
use Modules\Document\Src\Repositories\DocumentRepositoryInterface;
use Modules\Lessons\Src\Http\Requests\LessonRequest;
use Modules\Lessons\Src\Repositories\LessonsRepositoryInterface;
use Modules\Video\Src\Repositories\VideoRepositoryInterface;
use File;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;


class LessonsController extends Controller {
    protected $coursesRepository;
    protected $videoRepository;
    protected $documentRepository;
    protected $lessonRepository;



    public  function  __construct(CoursesRepositoryInterface $coursesRepository,
                                  VideoRepositoryInterface $videoRepository,
                                  DocumentRepositoryInterface $documentRepository,
                                  LessonsRepositoryInterface $lessonRepository

    )
    {
        $this->coursesRepository    = $coursesRepository;
        $this->videoRepository      = $videoRepository;
        $this->documentRepository   = $documentRepository;
        $this->lessonRepository     = $lessonRepository;
    }

    public function index($courseId) {
        $course = $this->coursesRepository->find($courseId);
        if ($course) {
            $courseName = $course->name;
        } else {
            $courseName = 'Course Not Found'; // Or display an error message
        }
        $pageTitle = 'List Lessons';
        return view('lessons::list', compact('pageTitle', 'courseId', 'courseName', 'course'));

    }

    public function data($courseId) {
        $lessons = $this->lessonRepository->getLessons($courseId)->get();

        $lessons = DataTables::of($lessons)->toArray();

        $lessons['data'] = $this->getLessonsTable($lessons['data']);
        return $lessons;
    }

    public function getLessonsTable($lessons, $char='', &$result=[]){
        if( !empty($lessons) ){
            foreach ($lessons as $lesson) {
                $row                = $lesson;

                if ($row['parent_id'] == Null) {
                    $row['name']        = $char.$row['name'];
                    $row['is_trial']    = '';
                    $row['view']        = '';
                    $row['duration']    = '';
                    $row['add']         = '<a href="'.route('admin.lessons.create', $row['course_id']). '?module='.$row['id']. '" class="btn btn-primary"> Thêm </a>';
                    $row['edit']        = '<a href="'.route('admin.lessons.edit', $row['id']).'" class="btn btn-warning"> Sửa </a>';
                    $row['delete']      = '<a href="'.route('admin.lessons.delete', $row['id']).'"  class="btn btn-danger delete-action"> Xoá </a>';
                } else {
                    $row['name']        = $char.$row['name'];
                    $row['is_trial']    = $row['is_trial'] == '1' ? 'Yes' : 'No';
                    $row['view']        = $row['view'];
                    $row['duration']    = getTimeDuration($row['duration']);
                    $row['add']         = '';
                    $row['edit']        = '<a href="'.route('admin.lessons.edit', $row['id']).'" class="btn btn-warning"> Sửa </a>';
                    $row['delete']      = '<a href="'.route('admin.lessons.delete', $row['id']).'"  class="btn btn-danger delete-action"> Xoá </a>';
                }


                unset($row['sub_lessons']);
                unset($row['course_id']);

                $result[]           = $row;

                if( !empty($lesson['sub_lessons']) ) {
                    $this->getLessonsTable($lesson['sub_lessons'], $char . '|-- ', $result);
                }
            }
        }
        return $result;
    }
    public function create($courseId) {

        $pageTitle = 'Add Lessons';
        $position = $this->lessonRepository->getPosition($courseId);
        $lessons  = $this->lessonRepository->getAllLessonsOfCourse($courseId);
        return view('lessons::add', compact('pageTitle', 'courseId', 'position', 'lessons'));
    }

    public function store(LessonRequest $request, $courseId) {

        $name = $request->name;
        $slug = $request->slug;
        $parent_id = $request->parent_id == 0 ? null : $request->parent_id;
        $is_trial = $request->is_trial;
        $position = $request->position;
        $description = $request->description;
        $course_id = $courseId;
        $status = $request->status == null ? 0 : $request->status;
        $document = $request->document_id;
        $documentId = null;

        if ($document) {
            $documentInfor = getFileInf($document);
            $document = $this->documentRepository->createDocument([
                'url' => $document,
                'size'=> $documentInfor['size'],
                'name' => $documentInfor['name']
            ], $document);

            $documentId = $document ? $document->id : null;
        }

        $videoUrl = $request->video_id;
        $videoId = null;

        if ($videoUrl) {
            $videoInfor = getVideoInf($videoUrl);
            $video = $this->videoRepository->createVideo(
                [
                    'url' => $videoUrl,
                    'name' => $videoInfor['filename'],
                    'size' => $videoInfor['playtime_seconds'],
                ], $videoUrl);

            $videoId = $video ? $video->id : null;
        }

        $this->lessonRepository->create([
            'name' => $name,
            'slug' => $slug,
            'video_id' => $videoId,
            'document_id' => $documentId,
            'parent_id' => $parent_id,
            'is_trial' => $is_trial,
            'position' => $position,
            'duration' => $videoInfor['playtime_seconds'] ?? 0,
            'description' => $description,
            'course_id' => $course_id,
            'status' => $status
        ]);
        $this->updateDurations($courseId);

        return redirect()->route('admin.lessons.index', $courseId)
            ->with('msg', __('lessons::messages.create.success'));
    }

    public function edit($lessonId) {
        $pageTitle = 'Edit Lessons';
        $lesson = $this->lessonRepository->find($lessonId);
        $lessons  = $this->lessonRepository->getAllLessonsOfCourse($lesson->course_id);

        if (!$lesson) {
            return abort(404);
        }
        $courseId = $lesson->course_id;
        return view('lessons::edit', compact('pageTitle', 'courseId', 'lessons', 'lesson'));
    }

    public function update(LessonRequest $request, $lessonId) {
        $name = $request->name;
        $slug = $request->slug;
        $parent_id = $request->parent_id == 0 ? null : $request->parent_id;
        $is_trial = $request->is_trial;
        $position = $request->position;
        $description = $request->description;
        $document = $request->document_id;
        $status = $request->status == null ? 0 : $request->status;

        $documentId = null;

        if ($document) {
            $documentInfor = getFileInf($document);
            $document = $this->documentRepository->createDocument([
                'url' => $document,
                'size'=> $documentInfor['size'],
                'name' => $documentInfor['name']
            ], $document);

            $documentId = $document ? $document->id : null;
        }

        $videoUrl = $request->video_id;
        $videoId = null;

        if ($videoUrl) {
            $videoInfor = getVideoInf($videoUrl);
            $video = $this->videoRepository->createVideo(
                [
                    'url' => $videoUrl,
                    'name' => $videoInfor['filename'],
                    'size' => $videoInfor['playtime_seconds'],
                ], $videoUrl);

            $videoId = $video ? $video->id : null;
        }

        $this->lessonRepository->update($lessonId,[
            'name' => $name,
            'slug' => $slug,
            'video_id' => $videoId,
            'document_id' => $documentId,
            'parent_id' => $parent_id,
            'is_trial' => $is_trial,
            'position' => $position,
            'duration' => $videoInfor['playtime_seconds'] ?? 0,
            'description' => $description,
            'status' => $status
        ]);

        $lesson = $this->lessonRepository->find($lessonId);
        $courseId = $lesson->course_id;

        $this->updateDurations($courseId);

        return redirect()->route('admin.lessons.index', $courseId)
            ->with('msg', __('lessons::messages.update.success'));
    }

    public function delete($lessonId) {
        $lesson = $this->lessonRepository->find($lessonId);
        if ($lesson) {
            $courseId = $lesson->course_id;
            $this->lessonRepository->delete($lessonId);
            $this->updateDurations($lesson->course_id);
            return redirect()->route('admin.lessons.index', $courseId)
                ->with('msg', __('lessons::messages.delete.success'));
        } else {
            return abort(404);
        }

    }

    private function updateDurations($courseId) {
        $lessons  = $this->lessonRepository->getAllLessonsOfCourse($courseId);
        $durations = $lessons->reduce(function($pre, $lesson){
            return $pre + $lesson->duration;
        }, 0);
         $this->coursesRepository->updateCourse($courseId,
        [ 'durations' => $durations ]);
    }

}
