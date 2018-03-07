<?php

namespace AaronAdrian\CollectiveForm;

use AaronAdrian\CollectiveForm\Services\FormHelper;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\ServiceProvider;

class CollectiveFormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind('form-helper', function() {
            return new FormHelper;
        });
        $this->registerRoutes();
        $this->registerOpenerMacro();
    }

    protected function registerOpenerMacro()
    {
        $this->app->afterResolving('form', function($builder) {
            $builder->macro('opener', function($opener) use ($builder) {
                return $builder->open(value(function() use($opener) {

                    if(is_array($opener))
                    {
                        return $opener;
                    }

                    if($opener instanceof Arrayable) {
                        return $opener->toArray();
                    }

                    if($opener instanceof Renderable) {
                        return $opener->render();
                    }

                    throw new \Exception('Object for Form::opener() is not an array, Arrayable, or Renderable.');

                }));
            });
        });
    }

    protected function registerRoutes()
    {
        if($this->app->environment('testing'))
        {
            $this->loadRoutesFrom(__DIR__.'/example-routes.php');
        }
    }
}