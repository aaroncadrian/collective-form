<?php

namespace AaronAdrian\CollectiveForm;

use AaronAdrian\CollectiveForm\Contracts\FormContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\ServiceProvider;

class CollectiveFormServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function boot()
    {
        $this->app->bind(FormContract::class, FormHelper::class);
        $this->registerRoutes();
        $this->registerOpenerMacro();
    }

    protected function registerOpenerMacro()
    {
        $builder = app('form');

        $builder->macro('opener', function($opener) use ($builder) {
            return $builder->open(value(function() use($opener) {

                if($opener instanceof Arrayable) {
                    return $opener->toArray();
                }

                if(is_array($opener))
                {
                    return $opener;
                }

                if($opener instanceof Renderable) {
                    return $opener->render();
                }

                throw new \Exception('Object for Form::opener() is not an array, Arrayable, or Renderable.');

            }));
        });
    }

    protected function registerRoutes()
    {
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