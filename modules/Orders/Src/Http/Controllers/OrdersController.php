<?php
namespace Modules\Orders\Src\Http\Controllers;

use App\Http\Controllers\Controller;

class OrdersController extends Controller {

    public function index() {
        return view('');
    }

    public function detail($id) {
        return $id;
    }
}
