<?php

namespace AaronAdrian\CollectiveForm;

trait FormHelperWhenCases
{
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