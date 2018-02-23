<?php

namespace AaronAdrian\CollectiveForm;

use AaronAdrian\CollectiveForm\Contracts\FormContract;
use Illuminate\Support\ServiceProvider;

class CollectiveFormServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function boot()
    {
        $this->app->bind(FormContract::class, FormHelper::class);

        if($this->app->environment('testing'))
        {
            $this->loadRoutesFrom(__DIR__.'/example-routes.php');
        }
    }

    public function provides()
    {
        return [
            FormContract::class,
        ];
    }
}