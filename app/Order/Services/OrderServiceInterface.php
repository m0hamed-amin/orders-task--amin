<?php

namespace App\Order\Services;

use App\Order\DTO\OrderDataObject;

interface OrderServiceInterface
{
    public function handleOrder(OrderDataObject $orderDataObject): void;
}
