<?php
declare(strict_types=1);

namespace App\Providers;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

class ControllerServiceProvider extends ServiceProvider
{
    public function register() :void {
        $this->app->singleton(LoginController::class, function (): LoginController {
            $generator = $this->app->get(UrlGenerator::class);
           return new LoginController($generator->route('my-recipes'));
        });
    }
}
