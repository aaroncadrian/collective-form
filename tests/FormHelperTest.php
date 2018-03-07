<?php

namespace AaronAdrian\CollectiveForm\Tests;

use AaronAdrian\CollectiveForm\Facades\Form;

class FormHelperTest extends TestCase
{

    /** @test */
    public function get_with_uri()
    {
        $this->assertArraySubset([
            'url' => 'http://form.test/example-show',
            'method' => 'get',
        ], Form::get('example.show')
            ->toArray());
    }

    /** @test */
    public function id_attribute()
    {
        $this->assertArraySubset([
            'id' => 'example-test-form',
        ], Form::get('example.show')->id('example-test-form')->toArray());
    }

    /** @test */
    public function post_with_url()
    {
        $this->assertArraySubset([
            'url' => 'https://api.somewhere.test/example',
            'method' => 'post',
        ], Form::post()
            ->url('https://api.somewhere.test/example')
            ->toArray());
    }

    /** @test */
    public function does_not_double_methods()
    {
        $this->assertArraySubset([
            'method' => 'patch',
        ], Form::post()
            ->patch()
            ->toArray());
    }

    /** @test */
    public function does_not_double_routes()
    {
        $this->assertArraySubset([
            'url' => 'https://api.somewhere.test/example',
        ], Form::get('example.show')
            ->url('https://api.somewhere.test/example')
            ->toArray());
    }

    /** @test */
    public function patch_with_url_and_files()
    {
        $this->assertArraySubset([
            'files' => true,
            'url' => 'https://api.somewhere.test/example',
            'method' => 'patch',
        ], Form::patch()
            ->url('https://api.somewhere.test/example')
            ->files()
            ->toArray());
    }

    /** @test */
    public function files_off()
    {
        $this->assertArraySubset([
            'files' => false,
        ], Form::post()
            ->files(false)
            ->toArray());
    }

    /** @test */
    public function route_testing()
    {
        $this->assertArraySubset([
            'url' => 'http://form.test/example-show',
        ], Form::post('example.show')
            ->toArray());
    }

    /** @test */
    public function route_testing_with_options()
    {
        $this->assertArraySubset([
            'url' => 'http://form.test/example-store/test',
        ], Form::post('example.store', ['form' => 'test'])
            ->toArray());
    }

    /** @test */
    public function use_the_with_method()
    {
        $this->assertArraySubset([
            'id' => 'testing-id',
        ], Form::post()
            ->url('/')
            ->with(['id' => 'testing-id'])
            ->toArray());
    }
}