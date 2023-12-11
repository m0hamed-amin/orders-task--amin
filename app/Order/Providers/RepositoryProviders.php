<?php

namespace App\Order\Providers;

use App\Order\Repositories\OrderRepository;
use App\Order\Repositories\OrderRepositoryInterface;
use App\Order\Repositories\StockRepository;
use App\Order\Repositories\StockRepositoryInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RepositoryProviders extends ServiceProvider implements DeferrableProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(StockRepositoryInterface::class, StockRepository::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            OrderRepositoryInterface::class,
            StockRepositoryInterface::class,
        ];
    }
}
