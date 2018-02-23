<?php

namespace AaronAdrian\CollectiveForm\Tests;

use AaronAdrian\CollectiveForm\Facades\Form;

class FormHelperTest extends TestCase
{

    /** @test */
    public function post_with_uri()
    {
        $form = Form::post('url/to/go/to')->toArray();
        $this->assertArraySubset([
            'url' => 'url/to/go/to',
            'method' => 'post',
        ], $form);
    }

    /** @test */
    public function post_with_url()
    {
        $form = Form::post('https://api.somewhere.test/example')->toArray();
        $this->assertArraySubset([
            'url' => 'https://api.somewhere.test/example',
            'method' => 'post',
        ], $form);
    }

    /** @test */
    public function post_with_url_and_files()
    {
        $form = Form::post('https://api.somewhere.test/example')->files()->toArray();
        $this->assertArraySubset([
            'files' => true,
        ], $form);
    }

    /** @test */
    public function files_off()
    {
        $form = Form::post('https://api.somewhere.test/example')->files(false)->toArray();
        $this->assertArraySubset([
            'files' => false,
        ], $form);
    }

    /** @test */
    public function route_testing()
    {
        $form = Form::post()->route('example.show')->toArray();
        $this->assertArraySubset([
            'url' => 'http://form.test/example-show',
        ], $form);
    }

    /** @test */
    public function route_testing_with_options()
    {
        $form = Form::post()->route('example.store', ['form' => 'test'])->toArray();
        $this->assertArraySubset([
            'url' => 'http://form.test/example-store/test',
        ], $form);
    }
}