<?php

namespace AaronAdrian\CollectiveForm;

class WhenCase
{
    /**
     * @var FormHelper
     */
    protected $form;

    /*
     * @var callable|boolean
     */
    protected $condition;

    /**
     * @var callable
     */
    protected $ifTrue;

    /**
     * @var callable
     */
    protected $ifFalse;

    /**
     * WhenCase constructor.
     *
     * @param FormHelper $form
     * @param callable|boolean $condition
     * @param callable $ifTrue
     * @param callable|null $ifFalse
     */
    public function __construct(FormHelper $form, $condition, callable $ifTrue, callable $ifFalse = null)
    {
        $this->form = $form;
        $this->condition = $condition;
        $this->ifTrue = $ifTrue;
        $this->ifFalse = $ifFalse;
    }

}