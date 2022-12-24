<?php

declare(strict_types=1);

namespace mss\Core\Shared\ValueObject;

use mss\Core\Shared\Exception\WrongIntervalException;

class TemperatureRange
{
    protected function __construct(
        protected readonly float $min,
        protected readonly float $max,
    ) {
        if ($this->max < $this->min) {
            throw WrongIntervalException::range($this->min, $this->max);
        }
    }

    public static function create(float $min, float $max): self
    {
        return new self($min, $max);
    }

    public function min(): float
    {
        return $this->min;
    }

    public function max(): float
    {
        return $this->max;
    }

    public function size(): float
    {
        return $this->max - $this->min;
    }
}
