<?php

namespace AaronAdrian\CollectiveForm\Tests;

use AaronAdrian\CollectiveForm\Facades\Form;

class FormHelperTest extends TestCase
{

    /** @test */
    public function get_with_uri()
    {
        $form = Form::get('example.show')->toArray();
        $this->assertArraySubset([
            'url' => 'http://form.test/example-show',
            'method' => 'get',
        ], $form);
    }

    /** @test */
    public function post_with_url()
    {
        $form = Form::post()->url('https://api.somewhere.test/example')->toArray();
        $this->assertArraySubset([
            'url' => 'https://api.somewhere.test/example',
            'method' => 'post',
        ], $form);
    }

    /** @test */
    public function patch_with_url_and_files()
    {
        $form = Form::patch()->url('https://api.somewhere.test/example')->files()->toArray();
        $this->assertArraySubset([
            'files' => true,
            'url' => 'https://api.somewhere.test/example',
            'method' => 'patch',
        ], $form);
    }

    /** @test */
    public function files_off()
    {
        $form = Form::post()->files(false)->toArray();
        $this->assertArraySubset([
            'files' => false,
        ], $form);
    }

    /** @test */
    public function route_testing()
    {
        $form = Form::post('example.show')->toArray();
        $this->assertArraySubset([
            'url' => 'http://form.test/example-show',
        ], $form);
    }

    /** @test */
    public function route_testing_with_options()
    {
        $form = Form::post('example.store', ['form' => 'test'])->toArray();
        $this->assertArraySubset([
            'url' => 'http://form.test/example-store/test',
        ], $form);
    }

    /** @test */
    public function use_the_with_method()
    {
        $form = Form::post()->url('/')->with(['id' => 'testing-id'])->toArray();
        $this->assertArraySubset([
            'id' => 'testing-id',
        ], $form);
    }
}