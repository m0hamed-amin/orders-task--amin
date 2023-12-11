<?php

namespace App\Order\Repositories;

use App\Order\DTO\OrderDataObject;

interface OrderRepositoryInterface
{
    public function createOrder(OrderDataObject $orderDataObject);

}
