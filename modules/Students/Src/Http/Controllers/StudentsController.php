<?php
namespace Modules\Students\Src\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Students\Src\Http\Requests\StudentsRequest;
use Modules\Students\Src\Repositories\StudentsRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;

class StudentsController extends Controller {

    protected $studentsRepository;

    public function __construct(StudentsRepositoryInterface $studentsRepository)
    {
        $this->studentsRepository = $studentsRepository;
    }

    public function index() {
        $pageTitle = 'List Students';
        return view('students::list', compact('pageTitle'));
    }

    public function data() {
        $students = $this->studentsRepository->getAllStudents();
        return DataTables::of($students)
            ->addColumn('edit', function ($student) {
                return '<a href="'.route('admin.students.edit', $student).'" class="btn btn-warning"> Sửa </a>'; })
            ->addColumn('delete', function ($student) {
                return '<a href="'.route('admin.students.delete', $student).'"  class="btn btn-danger delete-action"> Xoá </a>'; })
            ->editColumn('created_at', function ($student) {
                return Carbon::parse($student->created_at)->format('d/m/Y H:i:s'); })
            ->editColumn('status', function ($student) {
                return $student->status == 1 ? '<button class="btn btn-success" style="width: 106px; display: block; margin: 0 auto; "> active</button>'
                    : '<button class="btn btn-secondary" style=" display: block; margin: 0 auto; ">not active</button>'; })
            ->rawColumns(['edit', 'delete','status'])
            ->toJson();
    }

    public function create() {
        $pageTitle = 'Add New Student';
        return view('students::add', compact('pageTitle'));
    }

    public function store(StudentsRequest $request) {

        $this->studentsRepository->create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.students.index')
            ->with('msg', __('students::messages.create.success'));
    }

    public function edit($id) {
        $pageTitle = 'Edit Student';
        $student      = $this->studentsRepository->find($id);

        if (!$student) {
            abort(404);
        }else {
            return view('students::edit', compact('student', 'pageTitle'));
        }
    }

    public function update(StudentsRequest $request, $id) {
        $data  = $request->except('_token', 'password');

        if ($request->password) {
            $data['password']   = bcrypt($request->password);
        }

        $this->studentsRepository->update($id, $data);
        return redirect()->route('admin.students.index')
            ->with('msg', __('students::messages.update.success'));

    }

    public function delete($id) {
        $this->studentsRepository->delete($id);
        return redirect()->route('admin.students.index')
            ->with('msg', __('students::messages.delete.success'));
    }
}
