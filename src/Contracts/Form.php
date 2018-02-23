<?php

namespace AaronAdrian\CollectiveForm\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface Form extends Arrayable
{
    public function post($uri = '', array $options = []);

    public function get($uri = '', array $options = []);

    public function patch($uri = '', array $options = []);

    public function put($uri = '', array $options = []);

    public function delete($uri = '', array $options = []);

    public function route($uri, array $options = []);

    public function files($files = true);

    public function with(array $options);

}