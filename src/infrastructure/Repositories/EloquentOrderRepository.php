<?php

namespace Src\infrastructure\Repositories;

use Src\domain\Contracts\IOrderRepository;
use Src\domain\Models\Order;
use Src\infrastructure\Mappers\OrderMapper;

class EloquentOrderRepository implements IOrderRepository
{
    public function create(Order $order): Order
    {

    }

    public function findById(int $id): ?Order
    {
        $order = \App\Models\Order::find($id);

        if (!$order) {
            return null;
        }

        return OrderMapper::from($order);
    }
}
