<?php

namespace AaronAdrian\CollectiveForm\Tests;

use AaronAdrian\CollectiveForm\CollectiveFormServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;


class TestCase extends OrchestraTestCase
{

    protected function getPackageProviders($app)
    {
        return [CollectiveFormServiceProvider::class];
    }

}