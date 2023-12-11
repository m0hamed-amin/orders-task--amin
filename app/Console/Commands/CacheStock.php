<?php

namespace App\Console\Commands;

use App\Order\Services\OrderServiceInterface;
use Illuminate\Console\Command;

class CacheStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will cache the stock default to use it later';


    public function handle(OrderServiceInterface $orderService): void
    {
        $orderService->setInitials();
    }
}
