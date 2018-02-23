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

    public function post($uri = '', array $parameters = [])
    {
        return $this->set_method('post', $uri, $parameters);
    }

    public function get($uri = '', array $parameters = [])
    {
        return $this->set_method('get', $uri, $parameters);
    }

    public function patch($uri = '', array $parameters = [])
    {
        return $this->set_method('patch', $uri, $parameters);
    }

    public function put($uri = '', array $parameters = [])
    {
        return $this->set_method('put', $uri, $parameters);
    }

    public function delete($uri = '', array $parameters = [])
    {
        return $this->set_method('delete', $uri, $parameters);
    }

    public function files($files = true)
    {
        $this->attributes['files'] = $files;
        return $this;
    }

    protected function set_method($method, $uri = '', array $parameters = [])
    {
        $this->attributes['method'] = $method;
        if($uri) {
            $this->route($uri, $parameters);
        }
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
}