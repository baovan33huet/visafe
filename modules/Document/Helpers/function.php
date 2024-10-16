<?php
use Illuminate\Support\Facades\Storage;

function getFileInf($url) {
   $pathToGetSize = Storage::disk('public')->path(str_replace('/storage/', '', $url));
    return [
        'size' => File::size($pathToGetSize),
        'name' => basename($pathToGetSize),
    ];
}
