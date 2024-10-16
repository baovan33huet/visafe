<?php

use Illuminate\Support\Facades\Storage;

function getVideoInf($url) {
    $getID3 = new \getID3;
    $video_path = Storage::disk('public')->path(str_replace('/storage/', '', $url));
    $file = $getID3->analyze($video_path);
    return $file;
}
