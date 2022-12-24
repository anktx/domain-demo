<?php

declare(strict_types=1);

namespace mss\Core\Shared\ValueObject;

use mss\Core\Shared\Exception\DomainException;

class Positive
{
    protected function __construct(protected readonly float $value)
    {
        if ($this->value < 0) {
            throw DomainException::msg(sprintf('Cannot be negative, got `%f`', $this->value));
        }
    }

    public static function create(float $value, int $digits = 10): self
    {
        return new self(round($value, $digits));
    }

    public function value(): float
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }
}
