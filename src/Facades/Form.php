<?php

namespace AaronAdrian\CollectiveForm\Facades;

use AaronAdrian\CollectiveForm\Contracts\FormContract;
use Illuminate\Support\Facades\Facade;

class Form extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FormContract::class;
    }
}