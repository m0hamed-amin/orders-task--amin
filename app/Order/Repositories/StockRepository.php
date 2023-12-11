<?php

namespace App\Order\Repositories;

use App\Order\DTO\OrderDataObject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StockRepository implements StockRepositoryInterface
{
    private string $table = "stock";

    public function updateStock(Collection $stockData): void
    {
        foreach ($stockData as $stockRecord) {
            DB::table('stock')
                ->where('id', $stockRecord->id)
                ->update($this->prepareStock($stockRecord));
        }
    }

    private function prepareStock($stockRecord)
    {
        $stockArray = json_decode(json_encode ( $stockRecord ) , true);
        unset($stockArray['ingredient_id']);
        unset($stockArray['ingredient_name']);
        return $stockArray;
    }

    public function getCurrentStock() : Collection
    {
        return DB::table('stock')->get();
    }
}
