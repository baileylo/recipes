<?php

namespace App\Providers;

use App\Service\GlideSignature;
use Storage;
use Illuminate\Support\ServiceProvider;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\Server;
use League\Glide\ServerFactory;
use League\Glide\Urls\UrlBuilder;

class GlideServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            Server::class,
            GlideSignature::class,
            UrlBuilder::class
        ];
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Server::class, function () {
            $file_system = Storage::disk()->getDriver();

            return ServerFactory::create([
                'response'          => new LaravelResponseFactory(app('request')),
                'source'            => $file_system,
                'cache'             => $file_system,
                'cache_path_prefix' => '.cache',
                'base_url'          => '/img/',
                'defaults'          => ['q' => 80]
            ]);
        });

        $this->app->singleton(GlideSignature::class, function () {
            return new GlideSignature(config('app.glide_key'));
        });

        $this->app->singleton(UrlBuilder::class, function () {
            return new UrlBuilder('/img/', $this->app->get(GlideSignature::class));
        });
    }
}
