<?php

namespace App\Service;

use League\Glide\Urls\UrlBuilder;

class RenderableImage implements \JsonSerializable
{
    /** @var UrlBuilder */
    static private $url_builder;

    /** @var mixed[] */
    private $operations = [];

    /** @var string */
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @param UrlBuilder $url_builder
     */
    public static function setUrlBuilder(UrlBuilder $url_builder)
    {
        self::$url_builder = $url_builder;
    }

    public function __toString()
    {
        return static::$url_builder->getUrl($this->path, $this->operations);
    }

    public function __call($name, $value)
    {
        if (count($value) === 1) {
            $this->operations[$name] = $value[0];
        }

        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return (string)$this;
    }
}