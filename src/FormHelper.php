<?php

namespace AaronAdrian\CollectiveForm;

use AaronAdrian\CollectiveForm\Contracts\Form as FormContract;

class FormHelper implements FormContract
{
    protected $attributes;

    public function __construct()
    {
        $this->attributes = collect();
    }

    public function post($uri, array $options = [])
    {
        return $this->set_method('post', $uri, $options);
    }

    public function get($uri, array $options = [])
    {
        return $this->set_method('get', $uri, $options);
    }

    public function patch($uri, array $options = [])
    {
        return $this->set_method('patch', $uri, $options);
    }

    public function put($uri, array $options = [])
    {
        return $this->set_method('put', $uri, $options);
    }

    public function delete($uri, array $options = [])
    {
        return $this->set_method('delete', $uri, $options);
    }

    public function files($files = true)
    {
        $this->attributes['files'] = $files;
        return $this;
    }

    protected function set_method($method, $uri, array $options)
    {
        $this->attributes['method'] = $method;
        $this->attributes['url'] = value(function() use ($uri, $options) {
            if(count($options) === 0) {
                return $uri;
            }
            return route($uri, $options);
        });
        return $this;
    }

    public function toArray()
    {
        return $this->attributes->toArray();
    }

    public function with(array $options)
    {
        $this->attributes->merge($options);
        return $this;
    }
}