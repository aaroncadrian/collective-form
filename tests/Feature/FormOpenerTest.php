<?php

namespace AaronAdrian\CollectiveForm\Tests\Feature;

use AaronAdrian\CollectiveForm\Facades\Form;
use AaronAdrian\CollectiveForm\Tests\TestCase;
use Collective\Html\FormFacade;

class FormOpenerTest extends TestCase
{
    /**
     * @test
     * @group Opener
     */
    public function post_and_url()
    {
        $form = Form::post()->url('https://www.testing.com');
        $opener = (string) FormFacade::opener($form);
        $this->assertEquals('<form method="POST" action="https://www.testing.com" accept-charset="UTF-8"><input name="_token" type="hidden">', $opener);
    }

    /**
     * @test
     * @group Opener
     */
    public function id()
    {
        $form = Form::post()->url('https://www.testing.com')->id('test-form');
        $opener = (string) FormFacade::opener($form);
        $this->assertEquals('<form method="POST" action="https://www.testing.com" accept-charset="UTF-8" id="test-form"><input name="_token" type="hidden">', $opener);
    }
    
    /**
     * @test
     * @group Opener
     */
    public function add_attributes()
    {
        $form = Form::post()->url('https://www.testing.com')->addAttribute('name', 'test-form');
        $opener = (string) FormFacade::opener($form);
        $this->assertEquals('<form method="POST" action="https://www.testing.com" accept-charset="UTF-8" name="test-form"><input name="_token" type="hidden">', $opener);
    }

    /**
     * @test
     * @group Opener
     */
    public function with()
    {
        $form = Form::post()->url('https://www.testing.com')->with([
            'name' => 'test-form-name',
            'id' => 'test-form-id',
        ]);
        $opener = (string) FormFacade::opener($form);
        $this->assertEquals('<form method="POST" action="https://www.testing.com" accept-charset="UTF-8" name="test-form-name" id="test-form-id"><input name="_token" type="hidden">', $opener);
    }

    /**
     * @test
     * @group Opener
     */
    public function patch_when_true()
    {
        $form = Form::patchWhen(true, 'http://patch-url.test')->post()->url('https://www.testing.test')->with([
            'name' => 'test-form-name',
            'id' => 'test-form-id',
        ]);
        $opener = (string) FormFacade::opener($form);
        $this->assertEquals('<form method="POST" action="http://patch-url.test" accept-charset="UTF-8" name="test-form-name" id="test-form-id"><input name="_method" type="hidden" value="PATCH"><input name="_token" type="hidden">', $opener);
    }

    /**
     * @test
     * @group Opener
     */
    public function patch_when_false()
    {
        $form = Form::patchWhen(false, 'http://patch-url.test')->delete()->url('https://www.testing.test');
        $opener = (string) FormFacade::opener($form);
        $this->assertEquals('<form method="POST" action="https://www.testing.test" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden">', $opener);
    }

    /**
     * @test
     * @group Opener
     */
    public function route()
    {
        $form = Form::get('home');
        $opener = (string) FormFacade::opener($form);
        $this->assertEquals('<form method="GET" action="http://form.test/home" accept-charset="UTF-8">', $opener);
    }
}