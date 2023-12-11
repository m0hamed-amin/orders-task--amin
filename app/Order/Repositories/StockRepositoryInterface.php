<?php

namespace App\Order\Repositories;

use App\Order\DTO\OrderDataObject;
use Illuminate\Support\Collection;

interface StockRepositoryInterface
{
    public function updateStock(Collection $stockData);
}
