<?php

namespace Src\domain\Contracts;

use Src\domain\Models\Order;

interface IOrderRepository
{
    public function create(Order $order) : Order;
    public function findById(int $id) : ?Order;
}
