<?php

namespace AaronAdrian\CollectiveForm\Services\Traits;

trait FormHelperAttributes
{

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
     * @param bool $files
     * @return $this
     */
    public function files($files = true)
    {
        $this->attributes['files'] = $files;
        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function addAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * @param string $id
     * @return FormHelperAttributes
     */
    public function id($id)
    {
        return $this->addAttribute('id', $id);
    }
}