<?php

namespace AaronAdrian\CollectiveForm;

use AaronAdrian\CollectiveForm\Contracts\FormContract;

class FormHelper implements FormContract
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $attributes;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $whenCases;

    public function __construct()
    {
        $this->attributes = collect();
        $this->whenCases = collect();
    }

    public function post($uri = '', array $parameters = [])
    {
        return $this->method('post', $uri, $parameters);
    }

    public function get($uri = '', array $parameters = [])
    {
        return $this->method('get', $uri, $parameters);
    }

    public function patch($uri = '', array $parameters = [])
    {
        return $this->method('patch', $uri, $parameters);
    }

    public function put($uri = '', array $parameters = [])
    {
        return $this->method('put', $uri, $parameters);
    }

    public function delete($uri = '', array $parameters = [])
    {
        return $this->method('delete', $uri, $parameters);
    }

    public function files($files = true)
    {
        $this->attributes['files'] = $files;
        return $this;
    }

    public function method($method, $uri = '', array $parameters = [])
    {
        $this->attributes['method'] = $method;
        if($uri) {
            $this->route($uri, $parameters);
        }
        return $this;
    }

    public function toArray()
    {
        $this->render();
        return $this->attributes->toArray();
    }

    public function with(array $options)
    {
        $this->attributes = $this->attributes->merge($options);
        return $this;
    }

    public function route($uri, array $parameters = [])
    {
        $this->attributes['url'] = route($uri, $parameters);
        return $this;
    }

    public function url($url)
    {
        $this->attributes['url'] = $url;
        return $this;
    }

    public function when($condition, callable $ifTrue, callable $ifFalse = null)
    {
        $this->whenCases->push([
            'condition' => $condition,
            'ifTrue' => $ifTrue,
            'ifFalse' => $ifFalse,
        ]);

        return $this;
    }

    protected function render()
    {
        $this->renderWhenCases();
    }

    protected function renderWhenCases()
    {
        $this->whenCases->each(function($case) {
            if($case['condition']() === true)
            {
                return $case['ifTrue']($this);
            }

            if(!is_null($case['ifFalse']))
            {
                return $case['ifFalse']($this);
            }
        });

    }
}