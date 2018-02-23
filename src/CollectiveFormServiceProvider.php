<?php

namespace AaronAdrian\CollectiveForm;

use Illuminate\Support\ServiceProvider;

class CollectiveFormServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function boot()
    {
        $this->app->bind('form-helper', FormHelper::class);

        if($this->app->environment('testing'))
        {
            $this->loadRoutesFrom(__DIR__.'/example-routes.php');
        }
    }

    public function provides()
    {
        return [
            'form-helper',
        ];
    }
}