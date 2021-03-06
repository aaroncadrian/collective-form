<?php

namespace AaronAdrian\CollectiveForm\Services;

use AaronAdrian\CollectiveForm\Exceptions\CollectiveFormException;

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

    /**
     * @throws CollectiveFormException
     */
    public function handle()
    {
        if($this->conditionIsTrue()) {
            $this->handleTrue();
        } else {
            $this->handleFalse();
        }
    }

    protected function handleTrue()
    {
        call_user_func($this->ifTrue, $this->form);
    }

    protected function handleFalse()
    {
        if(!is_null($this->ifFalse))
        {
            call_user_func($this->ifFalse, $this->form);
        }
    }

    /**
     * @return bool
     * @throws CollectiveFormException
     */
    protected function conditionIsTrue()
    {
        if(is_bool($result = value($this->condition)))
        {
            return $result;
        }

        throw new CollectiveFormException('Condition does not resolve to be a boolean value');

    }

}