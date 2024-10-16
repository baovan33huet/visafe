<?php

namespace Modules\Auth\Src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\src\Http\Requests\RegisterRequest;
use Modules\Students\Src\Repositories\StudentsRepositoryInterface;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $studentrepository;

    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct(StudentsRepositoryInterface $studensrepository)
    {
        $this->middleware('guest:students');
        $this->studentrepository = $studensrepository;
    }



    public function showRegisterFormClient() {
        $pageTitle = 'Đăng kí';
        return view('auth::client.register',compact('pageTitle'));
    }

    public function registerFormClient(RegisterRequest $request) {
        $student = $this->studentrepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => 1,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            ]);

        if ($student) {
            Auth::guard('students')->loginUsingId($student->id);
            event(new Registered($student));
            $pageTitle = 'Vui lòng kích hoạt khoá học';

            return view('auth::client.verify', compact('pageTitle'));
        }else {
            return back()->with('msg', __('auth::messages.register.failure'));
        }
    }




}
