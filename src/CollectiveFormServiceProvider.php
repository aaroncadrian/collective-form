<?php

namespace AaronAdrian\CollectiveForm;

use Illuminate\Support\ServiceProvider;

class CollectiveFormServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function boot()
    {
        $this->app->bind('form-helper', FormHelper::class);
    }

    public function provides()
    {
        return [
            'form-helper',
        ];
    }
}