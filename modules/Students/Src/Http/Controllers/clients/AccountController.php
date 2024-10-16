<?php
namespace Modules\Students\Src\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Auth\src\Http\Requests\RegisterRequest;
use Modules\Orders\Src\Repositories\OrdersRepositoryInterface;
use Modules\Orders\Src\Repositories\OrderStatusRepositoryInterface;
use Modules\Students\Src\Http\Requests\StudentsRequest;
use Modules\Students\Src\Repositories\StudentsRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Modules\Teacher\Src\Repositories\TeacherRepositoryInterface;

class AccountController extends Controller {

    protected $studentsRepository;
    protected $teacherRepository;
    protected $orderRepository;
    protected $orderStatusRepository;

    public function __construct(
        StudentsRepositoryInterface $studentsRepository,
        TeacherRepositoryInterface $teacherRepository,
        OrdersRepositoryInterface $orderRepository,
        OrderStatusRepositoryInterface $orderStatusRepository
    )
    {
        $this->studentsRepository = $studentsRepository;
        $this->teacherRepository  = $teacherRepository;
        $this->orderRepository    = $orderRepository;
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function index() {
        $pageTitle = 'Tài Khoản';
        $pageName = 'Tài Khoản';

        return view('students::clients.account', compact('pageTitle', 'pageName' ));
    }

    public function profile() {
        $pageTitle = 'Thông tin cá nhân';
        $pageName = 'Thông tin cá nhân';

        $student = Auth::guard('students')->user();

        return view('students::clients.profile', compact('pageTitle', 'pageName', 'student'));
    }

    public function editProfile() {
        $pageTitle = 'Cập nhập thông tin';
        $pageName = 'Cập nhập thông tin';

        $student = Auth::guard('students')->user();
        return view('students::clients.update-profile', compact('pageTitle', 'pageName', 'student'));


    }
    public function updateProfile(RegisterRequest $request) {
        $id = Auth::guard('students')->id();

        $data  = $request->except('_token', 'password');

        if ($request->password) {
            $data['password']   = bcrypt($request->password);
        }

        if($id) {
            $this->studentsRepository->update($id, $data);
            return back()
                ->with('msg', __('students::messages.update.success'));
        }else {
            return abort(404);
        }
    }

    public function myCourses(Request $request) {
        $pageTitle = 'Khoá học của tôi';
        $pageName = 'Khoá học của tôi';
        $studentId = Auth::guard('students')->id();

        $teachers = $this->teacherRepository->getTeachersStudent();
        $filter = [];

        if ($request->teacher_id) {
            $filter['teacher_id'] = $request->teacher_id;
        }

        if ($request->keyword) {
            $filter['keyword'] = $request->keyword;
        }

        $courses = $this->studentsRepository->getCoursesStudent($studentId, $filter, config('paginate.account_limit'));
        return view('students::clients.my-courses', compact('pageTitle', 'pageName', 'courses', 'teachers'));

    }

    public function myOrders(Request $request) {
        $pageTitle = 'Đơn hàng của tôi';
        $pageName = 'Đơn hàng của tôi';
        $studentId = Auth::guard('students')->id();
        $filter = [];

        if ($request->start_date) {
            $filter['start_date'] = Carbon::parse($request->start_date)->format('Y-d-m') ;
        }

        if ($request->end_date) {
            $filter['end_date'] = Carbon::parse($request->end_date)->format('Y-d-m');
        }

        if ($request->total) {
            $filter['total'] = $request->total;
        }

        if ($request->status_id) {
            $filter['status_id'] = $request->status_id;
        }

        $orders = $this->orderRepository->getOrderByStudent($studentId, $filter);

        $orderStatus = $this->orderStatusRepository->getOrdersStatus();


        return view('students::clients.my-order', compact('pageTitle', 'pageName', 'orders', 'orderStatus'));

    }

    public function changePassword() {

    }

    public function updatePassword() {

    }


}
