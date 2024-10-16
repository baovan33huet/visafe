<?php
namespace Modules\Home\Src\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller {

    public function index() {
        $pageTitle = 'Trang chủ';
        return view('home::index', compact('pageTitle'));
    }

    public function detail($id) {
        return $id;
    }
}
