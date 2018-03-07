<?php

namespace AaronAdrian\CollectiveForm;

use AaronAdrian\CollectiveForm\Contracts\FormContract;

class FormHelper implements FormContract
{
    /**
     * Repository for all attributes.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $attributes;

    /**
     * Repository for all WhenCase instances.
     *
     * @see renderWhenCases
     *
     * @var \Illuminate\Support\Collection
     */
    protected $whenCases;

    /**
     * FormHelper constructor.
     */
    public function __construct()
    {
        $this->attributes = collect();
        $this->whenCases = collect();
    }

    /**
     * @param string $uri
     * @param array $parameters
     * @return $this
     */
    public function post($uri = '', array $parameters = [])
    {
        return $this->method('post', $uri, $parameters);
    }

    /**
     * @param string $uri
     * @param array $parameters
     * @return $this
     */
    public function get($uri = '', array $parameters = [])
    {
        return $this->method('get', $uri, $parameters);
    }

    /**
     * @param string $uri
     * @param array $parameters
     * @return $this
     */
    public function patch($uri = '', array $parameters = [])
    {
        return $this->method('patch', $uri, $parameters);
    }

    /**
     * @param string $uri
     * @param array $parameters
     * @return $this
     */
    public function put($uri = '', array $parameters = [])
    {
        return $this->method('put', $uri, $parameters);
    }

    /**
     * @param string $uri
     * @param array $parameters
     * @return $this
     */
    public function delete($uri = '', array $parameters = [])
    {
        return $this->method('delete', $uri, $parameters);
    }

    /**
     * @param bool $files
     * @return $this
     */
    public function files($files = true)
    {
        $this->attributes['files'] = $files;
        return $this;
    }

    /**
     * @param $method
     * @param string $uri
     * @param array $parameters
     * @return $this
     */
    public function method($method, $uri = '', array $parameters = [])
    {
        $this->attributes['method'] = $method;
        if($uri) {
            $this->route($uri, $parameters);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $this->renderWhenCases();
        return $this->attributes->toArray();
    }

    /**
     * Merge an array of options with current attributes collection.
     *
     * @see attributes
     *
     * @param array $options
     * @return $this
     */
    public function with(array $options)
    {
        $this->attributes = $this->attributes->merge($options);
        return $this;
    }

    /**
     * @param $uri
     * @param array $parameters
     * @return $this
     */
    public function route($uri, array $parameters = [])
    {
        $this->attributes['url'] = route($uri, $parameters);
        return $this;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function url($url)
    {
        $this->attributes['url'] = $url;
        return $this;
    }



}