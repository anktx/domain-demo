<?php

declare(strict_types=1);

namespace mss\Core\Shared\ValueObject\MdiIcon;

class IconScale
{
    protected function __construct(protected readonly float $value)
    {
    }

    public static function create(float $value): self
    {
        return new self($value);
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
