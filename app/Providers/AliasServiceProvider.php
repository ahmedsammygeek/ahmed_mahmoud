<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
class AliasServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Get the AliasLoader instance
        $loader = AliasLoader::getInstance();

        // Add your aliases
        $loader->alias('Youtube', \Dawson\Youtube\Facades\Youtube::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}