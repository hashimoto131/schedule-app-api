<?php
namespace App\Providers;

use Illuminate\Foundation\Application;
use App\Helpers\JwtAuthHelper;
use Illuminate\Support\ServiceProvider;

class JwtAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

     /**
      * Register the application services.
      *
      * @return void
      */
    public function register()
    {
        $this->app->bind('JwtAuth', JwtAuthHelper::class);
    }
}
