<?php

namespace AaronAdrian\CollectiveForm\Tests;

use AaronAdrian\CollectiveForm\Facades\Form;
use AaronAdrian\CollectiveForm\Services\FormHelper;

class FormHelperTest extends TestCase
{

    /**
     * @test
     * @covers FormHelper::get()
     */
    public function get_with_uri()
    {
        $this->assertArraySubset([
            'url' => 'http://form.test/example-show',
            'method' => 'get',
        ], Form::get('example.show')
            ->toArray());
    }

    /**
     * @test
     * @covers FormHelperAttributes::id()
     */
    public function id_attribute()
    {
        $this->assertArraySubset([
            'id' => 'example-test-form',
        ], Form::get('example.show')->id('example-test-form')->toArray());
    }

    /**
     * @test
     * @covers FormHelperAttributes::addAttribute()
     */
    public function add_attribute()
    {
        $this->assertArraySubset([
            'name' => 'example-test-form',
        ], Form::get('example.show')->addAttribute('name', 'example-test-form')->toArray());
    }

    /**
     * @test
     * @covers FormHelper::post()
     */
    public function post_with_url()
    {
        $this->assertArraySubset([
            'url' => 'https://api.somewhere.test/example',
            'method' => 'post',
        ], Form::post()
            ->url('https://api.somewhere.test/example')
            ->toArray());
    }

    /**
     * @test
     * @coversNothing
     */
    public function does_not_double_methods()
    {
        $this->assertArraySubset([
            'method' => 'patch',
        ], Form::post()
            ->patch()
            ->toArray());
    }

    /**
     * @test
     * @coversNothing
     */
    public function does_not_double_routes()
    {
        $this->assertArraySubset([
            'url' => 'https://api.somewhere.test/example',
        ], Form::get('example.show')
            ->url('https://api.somewhere.test/example')
            ->toArray());
    }

    /**
     * @test
     * @covers FormHelper::url()
     * @covers FormHelper::files()
     */
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

    /**
     * @test
     * @covers FormHelper::files()
     */
    public function files_off()
    {
        $this->assertArraySubset([
            'files' => false,
        ], Form::post()
            ->files(false)
            ->toArray());
    }

    /**
     * @test
     * @covers FormHelper::method()
     */
    public function route_testing()
    {
        $this->assertArraySubset([
            'url' => 'http://form.test/example-show',
        ], Form::post('example.show')
            ->toArray());
    }

    /**
     * @test
     * @covers FormHelper::method()
     */
    public function route_testing_with_options()
    {
        $this->assertArraySubset([
            'url' => 'http://form.test/example-store/test',
        ], Form::post('example.store', ['form' => 'test'])
            ->toArray());
    }

    /**
     * @test
     * @covers FormHelper::with()
     */
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