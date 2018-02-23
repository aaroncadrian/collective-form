<?php

namespace AaronAdrian\CollectiveForm;

use Collective\Html\Helpers\Contracts\Form;
use Collective\Html\Helpers\FormHelper;
use Illuminate\Support\ServiceProvider;

class CollectiveFormServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function boot()
    {
        $this->app->bind('form-helper', FormHelper::class);
    }
}