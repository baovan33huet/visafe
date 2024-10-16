<?php
namespace Modules\Carts\Src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Carts\Src\Models\Carts;
use Modules\Carts\Src\Repositories\CartsRepositoryInterface;


class CartsRepository extends BaseRepository implements CartsRepositoryInterface {

    public function getModel()
    {
        return Carts::class;
    }
    public function getAllCarts(){
        return $this->model->latest()->get();
    }

    public function updateOrCreate($arrCheck = [], $data = [])
    {
        return $this->model->updateOrCreate($arrCheck, $data);
    }

    public function checkCartExist($studentId, $courseId) {
        $cart = $this->model->where('student_id', $studentId)
                            ->where('course_id', $courseId)
                            ->first();

        return $cart;
    }
}
