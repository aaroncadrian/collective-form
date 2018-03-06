<?php

namespace AaronAdrian\CollectiveForm\Tests;

use AaronAdrian\CollectiveForm\Facades\Form;
use AaronAdrian\CollectiveForm\FormHelper;

class WhenTest extends TestCase
{
    /** @test */
    public function when_condition_is_true()
    {
        $form = Form::when(function() {
            return true;
        }, function(FormHelper $form) {
            return $form->patch()->url('/is-true');
        }, function(FormHelper $form) {
            return $form->post()->url('/is-false');
        })->toArray();

        $this->assertArraySubset([
            'method' => 'patch',
            'url' => '/is-true',
        ], $form);
    }
}