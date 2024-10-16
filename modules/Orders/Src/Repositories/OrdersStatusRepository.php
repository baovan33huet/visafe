<?php
namespace Modules\Orders\Src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Orders\Src\Models\OrderStatus;
use Modules\Orders\Src\Repositories\OrderStatusRepositoryInterface;


class OrdersStatusRepository extends BaseRepository implements OrderStatusRepositoryInterface {

    public function getModel()
    {
        return OrderStatus::class;
    }

    public function getOrdersStatus()
    {
        return $this->model->orderBy('name', 'ASC')->get();
    }

}
