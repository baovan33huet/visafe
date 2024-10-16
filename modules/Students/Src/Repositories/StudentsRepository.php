<?php
namespace Modules\Students\Src\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Modules\Students\Src\Models\Students;
use Modules\Students\Src\Repositories\StudentsRepositoryInterface;


class StudentsRepository extends BaseRepository implements StudentsRepositoryInterface {

    public function getModel()
    {
        return Students::class;
    }

    public function getStudents($limit)
    {
        return $this->model->paginate($limit);
    }

    public function setPassword($password, $id)
    {
        return $this->update($id, ['password' => Hash::make($password)]);
    }

    public function getAllStudents() {
        return $this->model->select(['id', 'name', 'email', 'status', 'created_at'])->latest();
    }
    public function checkPassword($password, $id)
    {
        $student            = $this->find($id);

        if( $student ) {
            $hashPassword = $student->password;
            return Hash::check($password, $hashPassword);
        }

        return false;
    }

    public function getCoursesStudent($studentId, $filter = [], $limit) {

        $student = $this->find($studentId);

        if (!$student) {
            return abort(404);
        }

        $query = $student->courses();


        if ( !empty($filter['teacher_id']) ) {
            $query->where('teacher_id', $filter['teacher_id']);
        }

        if ( !empty($filter['keyword']) ) {
            $keyword = $filter['keyword'];
            $query->where(function ($builder) use ($keyword) {
                $builder->where('name', 'like', '%' . $keyword . '%');
                $builder->orWhere('detail', 'like', '%' . $keyword . '%');
            });
        }

        return $query->paginate($limit);
    }

    public function getAllCoursesOfStudent($studentId) {
        $student = $this->find($studentId);

        return $student->courses()->get();
    }
}
