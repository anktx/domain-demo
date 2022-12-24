<?php

declare(strict_types=1);

namespace mss\Core\Source\Json\Builder;

abstract class AbstractJsonBuilder
{
    protected \stdClass $obj;

    final protected function __construct(string $json)
    {
        $this->obj = json_decode($json, flags: JSON_THROW_ON_ERROR);
    }

    public static function load(string $json): static
    {
        return new static($json);
    }
}
