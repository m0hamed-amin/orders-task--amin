<?php

namespace App\Order\Repositories;

use App\Order\DTO\OrderDataObject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    private string $table = "orders";

    public function createOrder(OrderDataObject $orderDataObject): int
    {
        return DB::table($this->table)->insertGetId($orderDataObject->prepareForOrder());
    }

    public function createOrderProduct(OrderDataObject $orderDataObject, int $orderId): void
    {
        $orderProductData = $orderDataObject->prepareForOrderProduct();
        $orderProductData['order_id'] = $orderId;
        DB::table('orders_products')->insert($orderProductData);
    }

    public function getProductQuantities(OrderDataObject $orderDataObject): Collection
    {
        return DB::table('ingredients')
            ->join('stock', 'ingredients.id', '=', 'stock.ingredient_id')
            ->where('product_id', $orderDataObject->getProductId())
            ->select(
                'ingredients.quantity  as product_quantity',
                'ingredients.id as ingredient_id',
                'ingredients.ingredient_name',
                'stock.quantity',
                'stock.id'
            )
            ->get();
    }

    public function getProductById(OrderDataObject $orderDataObject)
    {
        $productId = DB::table('products')->find($orderDataObject->getProductId());
        return (bool)$productId;
    }

    public function beginTransaction(): void
    {
        DB::beginTransaction();
    }

    public function commitTransaction(): void
    {
        DB::commit();
    }
}
