<?php
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;

function getLessons( $lessons, $old='', $parentId = 0, $char=''  ) {

    $id = request()->route()->lesson;
    if ($lessons) {
        foreach ($lessons as $key => $lesson) {
            if ( $lesson->parent_id == $parentId && $id != $lesson->id) {
                echo '<option value="'. $lesson->id .'"';
                if ( $old == $lesson->id ) {
                    echo ' selected';
                }
                echo '>' . $char . $lesson->name . '</option>';
                unset($lessons[$key]);
                getLessons($lessons, $old, $lesson->id, $char . ' |-- ');
            }
        }
    }
}

function getTimeDuration($time) {
    $min = floor($time / 60);
    $second = floor($time - $min * 60);
    $min = $min < 10 ? '0' . $min : $min;
    $second = $second < 10 ? '0' . $second : $second;

    return "$min:$second";

}

function getLessonCount($course) {
    $lessonRepository = new \Modules\Lessons\Src\Repositories\LessonsRepository();
    return $lessonRepository->getLessonsCount($course);

}

function getModuleByPosition($course) {
    $lessonRepository = new \Modules\Lessons\Src\Repositories\LessonsRepository();
    return $lessonRepository->getModuleByPosition($course);
}

function getLessonByPosition($course, $moduleId = null, $isDocument = false) {
    $lessonRepository = new \Modules\Lessons\Src\Repositories\LessonsRepository();
    return $lessonRepository->getLessonByPosition($course, $moduleId, $isDocument);
}
