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
}