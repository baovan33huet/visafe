<?php
namespace Modules\Orders\Src\Repositories;

use App\Repositories\RepositoryInterface;

interface OrdersRepositoryInterface extends RepositoryInterface {

    public function getOrderByStudent($studentId, $filter = []);
}
