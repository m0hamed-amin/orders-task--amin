<?php

namespace App\Order\Factories;

use App\Order\DTO\OrderDataObject;
use App\Order\Requests\OrderRequest;


class OrderFactory
{
    public static function fromRequest(OrderRequest $request): OrderDataObject
    {
        $products = $request->get('products');
        return new OrderDataObject($products[0]['product_id'],$products[0]['quantity']);
    }
}
