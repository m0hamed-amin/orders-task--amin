<?php

namespace App\Order\Services;


use App\Exceptions\ProductNotfound;
use App\Jobs\SendEmailJob;
use App\Order\DTO\OrderDataObject;
use App\Order\Repositories\OrderRepositoryInterface;
use App\Order\Repositories\StockRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Cache;


class OrderService implements OrderServiceInterface
{

    private OrderRepositoryInterface $orderRepository;
    private StockRepositoryInterface $stockRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        StockRepositoryInterface $stockRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->stockRepository = $stockRepository;
    }


    /**
     * @throws Exception
     */
    public function handleOrder(OrderDataObject $orderDataObject): void
    {
        $this->orderRepository->beginTransaction();
        $this->createOrder($orderDataObject);
        $this->decreaseStock($orderDataObject);
        $this->orderRepository->commitTransaction();
    }

    /**
     * @throws Exception
     */
    private function createOrder(OrderDataObject $orderDataObject): void
    {
        if ($this->checkIfExistedProduct($orderDataObject)) {
            $orderId = $this->orderRepository->createOrder($orderDataObject);
            $this->orderRepository->createOrderProduct($orderDataObject, $orderId);
        }
    }

    private function checkIfExistedProduct(OrderDataObject $orderDataObject): bool
    {
        return $this->orderRepository->getProductById($orderDataObject);
    }

    private function decreaseStock(OrderDataObject $orderDataObject): void
    {
        $stockWithIngredients = $this->orderRepository->getProductQuantities($orderDataObject);
        $stock = $stockWithIngredients->map(
            function (object $item ) use ($orderDataObject) {
                $item->product_quantity = $item->product_quantity * $orderDataObject->getQuantity();
                $item->quantity = $item->quantity - $item->product_quantity;
                unset($item->product_quantity);
                return $item;
            });
        $this->stockRepository->updateStock($stock);
        $this->checkCurrentStock($stock);
    }

    public function checkCurrentStock($currentStocks): void
    {
        // check if it is under 50% or not
        foreach ($currentStocks as $stock) {
            $defaultStock = Cache::get($stock->ingredient_id);
            $sentEmail = Cache::get($stock->ingredient_name . $stock->ingredient_id);
            if ($stock->quantity < ($defaultStock / 2) && $sentEmail == 1) {
                SendEmailJob::dispatch(new SendEmailJob($stock->ingredient_name, "merchant@foodics.com"));
                $this->changeEmailStatus($stock->ingredient_id, $stock->ingredient_name);
            }
        }
    }

    public function setInitials(): void
    {
        // construct key for redis - set values for once using "add" method
        // $key => $ingredient_id & $value => initial quantity
        Cache::add('1', '20000', 86400);
        Cache::add('2', '5000', 86400);
        Cache::add('3', '1000', 86400);

//        // flag to set sentEmail with 0 with each Ingredient
        // $key => $ingredient_id & $value => initial quantity
        Cache::add('1-Beef', 0);
        Cache::add('2-Cheese', 0);
        Cache::add('3-Onion', 0);
    }

    public function changeEmailStatus(int $ingredient_id, string $ingredient_name)
    {
        $key = $ingredient_id . "-" . $ingredient_name;
        Cache::forget($key);
        Cache::add($key, 1);
    }
}
