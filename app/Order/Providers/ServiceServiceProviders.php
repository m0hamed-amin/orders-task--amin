<?php

namespace App\Order\Providers;

use App\Order\Services\OrderService;
use App\Order\Services\OrderServiceInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProviders extends ServiceProvider implements DeferrableProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            OrderServiceInterface::class,
        ];
    }
}

