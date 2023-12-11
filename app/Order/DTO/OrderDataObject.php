<?php

namespace App\Order\DTO;

use Carbon\Carbon;

class OrderDataObject
{

    /**
     * @var int
     */
    private int $product_id;

    /**
     * @var int
     */
    private int $quantity;


    /**
     * @param int $product_id
     * @param int $quantity
     */
    public function __construct(int $product_id, int $quantity)
    {
        $this->product_id = $product_id;
        $this->quantity =$quantity;
    }


    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return array
     */
    public function prepareForOrder(): array
    {
        $order['quantity'] = $this->getQuantity();
        $order['created_at'] = Carbon::now();
        $order['updated_at'] = Carbon::now();
        return $order;
    }

    public function prepareForOrderProduct(): array
    {
        $order['product_id'] = $this->getProductId();
        $order['created_at'] = Carbon::now();
        $order['updated_at'] = Carbon::now();
        return $order;
    }

    public function prepareForStock(): array
    {
        $orderData['quantity'] = $this->getQuantity();
        $orderData['product_id'] = $this->getProductId();
        return $orderData;
    }

//    public function toArray(): array
//    {
//        return $this->prepareDTO($this->prepareOrder());
//    }

}
