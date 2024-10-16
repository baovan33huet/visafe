<?php
namespace Modules\Orders\Src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Orders\Src\Models\Order;
use Modules\Orders\Src\Repositories\OrdersRepositoryInterface;


class OrdersRepository extends BaseRepository implements OrdersRepositoryInterface {

    public function getModel()
    {
        return Order::class;
    }

    public function getOrderByStudent($studentId, $filter = []) {

        $query = $this->model->where('student_id', $studentId);

        if (!empty($filter['status_id'])) {
            $query = $query->where('status_id', $filter['status_id']);
        }
        if (!empty($filter['start_date'])) {
            $query = $query->whereDate('created_at', '>=' , $filter['start_date']);
        }
        if (!empty($filter['end_date'])) {
            $query = $query->whereDate('created_at', '<=', $filter['end_date']);
        }
        if (!empty($filter['total']) && $filter['total'] > 0) {
            $query = $query->where('total', '>=', $filter['total']);
        }

        return $query->latest()->get();
    }

}
