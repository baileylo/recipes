<?php

namespace App\Service;

/**
 * This object can be used in the place of RenderableImage
 */
class NullImage implements \JsonSerializable
{
    public function __call($function, $value)
    {
        return $this;
    }

    public function __toString()
    {
        return '';
    }

    public function jsonSerialize()
    {
        return (string)$this;
    }
}