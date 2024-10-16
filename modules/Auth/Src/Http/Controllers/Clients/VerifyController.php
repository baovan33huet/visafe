<?php

namespace Modules\Auth\Src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class VerifyController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        if ($user->hasVerifiedEmail()) {
            return redirect('/home');
        }
        $pageTitle = 'Vui lòng kích hoạt tài khoản hoặc khoá học';
        return view('auth::client.verify',compact('pageTitle'));
    }
    public function resendEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return redirect()->route('verification.notice')->with('msg', 'Email đã được gửi lại thành công');
    }
}
