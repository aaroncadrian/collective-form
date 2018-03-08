<?php

namespace AaronAdrian\CollectiveForm\Services\Traits;

use AaronAdrian\CollectiveForm\Services\WhenCase;

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
     * @param bool|callable $condition
     * @param string $url
     * @return $this
     */
    public function getWhen($condition, $url)
    {
        $this->when($condition, function($form) use($url) {
            $form->get()->url($url);
        });
        return $this;
    }

    /**
     * @param bool|callable $condition
     * @param string $url
     * @return $this
     */
    public function postWhen($condition, $url)
    {
        $this->when($condition, function($form) use($url) {
            $form->post()->url($url);
        });
        return $this;
    }

    /**
     * @param bool|callable $condition
     * @param string $url
     * @return $this
     */
    public function patchWhen($condition, $url)
    {
        $this->when($condition, function($form) use($url) {
            $form->patch()->url($url);
        });
        return $this;
    }

    /**
     * @param bool|callable $condition
     * @param string $url
     * @return $this
     */
    public function putWhen($condition, $url)
    {
        $this->when($condition, function($form) use($url) {
            $form->put()->url($url);
        });
        return $this;
    }

    /**
     * @param bool|callable $condition
     * @param string $url
     * @return $this
     */
    public function deleteWhen($condition, $url)
    {
        $this->when($condition, function($form) use($url) {
            $form->delete()->url($url);
        });
        return $this;
    }

    /**
     * Handle each WhenCase.
     *
     * @return void
     */
    protected function renderWhenCases()
    {
        $this->whenCases->each->handle();
    }
}