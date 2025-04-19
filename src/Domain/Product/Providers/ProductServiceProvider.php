<?php

namespace Domain\Product\Providers;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

    }

    public function register()
    {
        $this->app->register(
            ActionsServiceProvider::class
        );
    }
}
