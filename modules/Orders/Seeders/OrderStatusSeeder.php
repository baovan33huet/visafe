<?php

namespace Modules\Orders\Seeders;

use Illuminate\Database\Seeder;
use Modules\Orders\Src\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Đã thanh toán'
            ],
            [
                'name' => 'Chờ thanh toán'
            ],
            [
                'name' => 'Thanh toán thất bại'
            ],
            [
                'name' => 'Huỷ thanh toán'
            ]
        ];

        OrderStatus::insert($data);
    }
}
