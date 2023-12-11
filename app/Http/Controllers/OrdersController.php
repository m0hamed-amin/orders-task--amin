<?php

namespace App\Http\Controllers;

use App\Order\Factories\OrderFactory;
use App\Order\Requests\OrderRequest;
use App\Order\Services\OrderServiceInterface;
use App\Http\Common\APIResponse;
use Illuminate\Http\JsonResponse;

class OrdersController extends Controller
{
    use APIResponse;

    private OrderServiceInterface $orderService;


    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param OrderRequest $orderRequest
     * @return JsonResponse
     */
    public function createOrder(OrderRequest $orderRequest): JsonResponse
    {
        $orderDTO = OrderFactory::fromRequest($orderRequest);
        $this->orderService->handleOrder($orderDTO);

        return $this->success([]);
    }
}
