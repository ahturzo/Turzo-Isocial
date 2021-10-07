<?php
namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\FirstInterface',
            'App\Repositories\BlogRepository'
        );
    }
}
