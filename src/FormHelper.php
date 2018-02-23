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

    public function post($url = '', array $options = [])
    {
        return $this->set_method('post', $url, $options);
    }

    public function get($url = '', array $options = [])
    {
        return $this->set_method('get', $url, $options);
    }

    public function patch($url = '', array $options = [])
    {
        return $this->set_method('patch', $url, $options);
    }

    public function put($url = '', array $options = [])
    {
        return $this->set_method('put', $url, $options);
    }

    public function delete($url = '', array $options = [])
    {
        return $this->set_method('delete', $url, $options);
    }

    public function files($files = true)
    {
        $this->attributes['files'] = $files;
        return $this;
    }

    protected function set_method($method, $url = '', array $options = [])
    {
        $this->attributes['method'] = $method;

        if($url) {
            $this->attributes['url'] = value(function() use ($url, $options) {
                if(count($options) === 0) {
                    return $url;
                }
                return route($url, $options);
            });
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

    public function route($uri, array $options = [])
    {
        $this->attributes['url'] = route($uri, $options);
        return $this;
    }
}