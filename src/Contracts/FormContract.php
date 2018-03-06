<?php

namespace AaronAdrian\CollectiveForm\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface FormContract extends Arrayable
{
    public function post($uri = '', array $parameters = []);

    public function get($uri = '', array $parameters = []);

    public function patch($uri = '', array $parameters = []);

    public function put($uri = '', array $parameters = []);

    public function delete($uri = '', array $parameters = []);

    public function route($uri, array $parameters = []);

    public function url($url);

    public function files($files = true);

    public function with(array $options);

    public function when(callable $condition, callable $ifTrue, callable $ifFalse);

}