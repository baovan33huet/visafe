<?php

namespace Modules\Auth\Src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\Auth\Src\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function __construct()
    {
        $this->middleware('guest:students', ['except' => ['LogoutClient']]);
    }

    public function showLoginFormClient()
    {
        $pageTitle = 'Đăng nhập';

        return view('auth::client.login',compact('pageTitle'));
    }

    public function LoginClient (LoginRequest $request)
    {
        $dataLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $status = Auth::guard('students')->attempt($dataLogin,  $request->remember == 1 ? true : false);

        if ($status) {
            return redirect('/home');
        }
        return back()->with('msg', __('auth::messages.login.failure'));
    }

    public function LogoutClient() {
        Auth::guard('students')->logout();
        return redirect('/home');
    }





}
