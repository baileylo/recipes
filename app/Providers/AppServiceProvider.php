<?php

namespace App\Providers;

use App\Service\RenderableImage;
use Illuminate\Support\ServiceProvider;
use League\Glide\Urls\UrlBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
        RenderableImage::setUrlBuilder($this->app[UrlBuilder::class]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
