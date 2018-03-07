<?php

namespace AaronAdrian\CollectiveForm;

trait FormHelperWhenCases
{
    /**
     * Repository for all WhenCase instances.
     *
     * @see renderWhenCases
     *
     * @var \Illuminate\Support\Collection
     */
    protected $whenCases;

    /*
     * Complete all WhenCase logic for the FormHelper constructor.
     */
    protected function constructWhenCases()
    {
        if(is_null($this->whenCases))
        {
            $this->whenCases = collect();
        }
    }

    /**
     * Register a WhenCase.
     *
     * @param bool|callable $condition
     * @param callable $ifTrue
     * @param callable|null $ifFalse
     * @return $this
     */
    public function when($condition, callable $ifTrue, callable $ifFalse = null)
    {
        $this->whenCases->push(new WhenCase($this, $condition, $ifTrue, $ifFalse));
        return $this;
    }

    /**
     * Handle each WhenCase.
     *
     * @return void
     */
    protected function renderWhenCases()
    {
        $this->whenCases->each(function(WhenCase $case) {
            $case->handle();
        });
    }
}