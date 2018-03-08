<?php

namespace AaronAdrian\CollectiveForm\Facades;

use Illuminate\Support\Facades\Facade;

class Form extends Facade
{
    /**
     * Get facade accessor for Form.
     *
     * @see \AaronAdrian\CollectiveForm\CollectiveFormServiceProvider::registerFormHelper()
     * @see \AaronAdrian\CollectiveForm\Services\FormHelper
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'form-helper';
    }
}