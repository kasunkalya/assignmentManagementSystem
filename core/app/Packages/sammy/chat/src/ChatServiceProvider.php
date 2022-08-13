<?php
namespace Sammy\Chat;

use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * User: kalya
 * Date: 1/5/2016
 * Time: 10:41 AM
 */
class ChatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'Chat');
        require __DIR__ . '/Http/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Chat', function($app){
            return new Books;
        });
    }

}