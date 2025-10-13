<?php

namespace Src\infrastructure\Mappers;

use App\Models\Order;
use Src\domain\Models\User;

class OrderMapper
{
    public static function from(Order $order) : \Src\domain\Models\Order
    {
        $user = new User(
            name: $order->user->name,
            email: new \Src\domain\ValueObjects\Email($order->user->email),
            password: $order->user->password,
            id: $order->user->id
        );


    }
}
