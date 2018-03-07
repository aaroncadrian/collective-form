<?php

namespace AaronAdrian\CollectiveForm\Tests;

use AaronAdrian\CollectiveForm\CollectiveFormException;
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

    /** @test */
    public function when_condition_is_false()
    {
        $form = Form::when(function() {
            return false;
        }, function(FormHelper $form) {
            return $form->patch()->url('/is-true');
        }, function(FormHelper $form) {
            return $form->post()->url('/is-false');
        })->toArray();

        $this->assertArraySubset([
            'method' => 'post',
            'url' => '/is-false',
        ], $form);
    }

    /** @test */
    public function when_condition_is_false_without_ifFalse_callable()
    {
        $form = Form::when(function() {
            return false;
        }, function(FormHelper $form) {
            return $form->patch()->url('/is-true');
        })->post()->url('/is-false')->toArray();

        $this->assertArraySubset([
            'method' => 'post',
            'url' => '/is-false',
        ], $form);
    }

    /** @test */
    public function when_condition_is_true_without_ifFalse_callable_positioned_before()
    {
        $form = Form::post()->url('/is-false')->when(function() {
            return true;
        }, function(FormHelper $form) {
            return $form->patch()->url('/is-true');
        })->toArray();

        $this->assertArraySubset([
            'method' => 'patch',
            'url' => '/is-true',
        ], $form);
    }

    /** @test */
    public function when_condition_is_true_without_ifFalse_callable_positioned_after()
    {
        $form = Form::when(function() {
            return true;
        }, function(FormHelper $form) {
            return $form->patch()->url('/is-true');
        })->post()->url('/is-false')->toArray();

        $this->assertArraySubset([
            'method' => 'patch',
            'url' => '/is-true',
        ], $form);

    }

    /** @test */
    public function expect_exception_if_pass_string_as_condition()
    {
        $this->expectException(CollectiveFormException::class);
        $this->expectExceptionMessage('Condition does not resolve to be a boolean value');
        Form::when('true', function(FormHelper $form) {
            return $form->patch()->url('/is-true');
        })->post()->url('/is-false')->toArray();
    }

    /** @test */
    public function expect_exception_if_pass_callable_returning_string_as_condition()
    {
        $this->expectException(CollectiveFormException::class);
        $this->expectExceptionMessage('Condition does not resolve to be a boolean value');
        Form::when(function() {
            return 'true';
        }, function(FormHelper $form) {
            return $form->patch()->url('/is-true');
        })->post()->url('/is-false')->toArray();
    }
}