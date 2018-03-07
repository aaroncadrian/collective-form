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
    public function post_with_opener()
    {
        $form = Form::post()->url('https://www.testing.com');
        $opener = (string) FormFacade::opener($form);
        $this->assertEquals('<form method="POST" action="https://www.testing.com" accept-charset="UTF-8"><input name="_token" type="hidden">', $opener);
    }
}