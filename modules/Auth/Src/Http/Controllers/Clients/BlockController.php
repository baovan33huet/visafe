<?php

namespace Modules\Auth\Src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BlockController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        if ($user->status) {
            return redirect('/home');
        }
        $pageTitle = 'Tài khoản của bạn đã bị khoá không vào được đây';
        return view('auth::client.block',compact('pageTitle'));

    }

    public function checkCourseStudent() {
        $pageTitle = 'Vui lòng kích hoạt tài khoản hoặc khoá học';
        return view('auth::client.verify',compact('pageTitle'));
    }




}
