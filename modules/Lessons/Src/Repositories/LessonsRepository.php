<?php
namespace Modules\Lessons\Src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Lessons\Src\Models\Lessons;
use Modules\Lessons\Src\Repositories\LessonsRepositoryInterface;


class LessonsRepository extends BaseRepository implements LessonsRepositoryInterface {

    public function getModel()
    {
        return Lessons::class;
    }

    public function getPosition($courseId) {
        $result = $this->model->where('course_id', $courseId)->count();
        return $result + 1;
    }

    public function getLessons($courseId) {
       $courseId = (int)$courseId;
        return $this->model->with('subLessons')
            ->select(['id', 'name','slug','is_trial', 'parent_id', 'view', 'duration', 'course_id'])
            ->whereNull('parent_id')
            ->where('course_id', $courseId)
            ->orderBy('position', 'asc');
    }

    public function getAllLessonsOfCourse($courseId) {
        return $this->model->where('course_id', $courseId)->get();
    }

    public function getLessonsCount($course) {
        return (object)  [
            'module' => $course->lessons->whereNull('parent_id')->count(),
            'lesson' => $course->lessons->whereNotNull('parent_id')->count()
        ];
    }

    public function getModuleByPosition($course) {
        return $course->lessons()->whereNull('parent_id')->orderBy('position')->get();
    }

    public function getLessonByPosition($course, $moduleId = null, $isDocument = false) {
        $query = $course->lessons();

        if ($moduleId) {
            $query = $query->where('parent_id', $moduleId);
        } else {
            $query = $query->whereNotNull('parent_id');
        }
        if ($isDocument) {
            $query = $query->whereNotNull('document_id');
        }

        return $query->orderBy('position')->get();
    }

    public function getLessonClient($slug) {
        return $this->model->whereSlug($slug)->first();
    }
}
