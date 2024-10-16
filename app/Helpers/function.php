<?php

use Illuminate\Support\Facades\File;

function deleteFileStorage($image) {

    $imageThumbs = dirname($image) . '/thumbs/' . basename($image);
    File::delete(public_path($image));
    File::delete(public_path($imageThumbs));

}

function isRoute($routeList) {
    if (!empty($routeList)) {
        foreach ($routeList as $route) {
            if ( request()->is(trim($route, '/')) ) {
                return true;
            }
        }
    }
    return false;
}

function activeSidebar($name, $routeList) {
    return request()->is(trim(route('admin.' . $name . '.index', [], false), '/') .  '/*')
        || request()->is(trim(route('admin.' . $name . '.index', [], false), '/'))
        || isRoute($routeList);
}

function activeMenu($name) {
    return request()->is(trim(route($name , [], false), '/'));
}

function money($number, $currency = 'đ') {
    return !empty($number) ? number_format($number) . $currency : 'Miễn phí';
}

function getTimeClient($second) {
    $min = round($second / 60, 1);
    $hour = round($min / 60, 1) == 0 ? 0 : round($min / 60, 1);

    $time = $hour !== 0 ? $hour .'h' : $min .'p';
    return $time;
}

function getTimeClientDetail($second) {
    $min = round($second / 60, 1);
    $hour = round($min / 60, 2) == 0 ? 0 : round($min / 60, 1);

    return $hour;
}

function getSize($size) {
    $result = round($size / 1024, 2);
    return $result . 'KB';
}
