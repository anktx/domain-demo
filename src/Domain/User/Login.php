<?php

declare(strict_types=1);

namespace mss\Core\Domain\User;

class Login
{
    protected function __construct(protected readonly string $value)
    {
    }

    public static function create(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(Login $other): bool
    {
        return $this->value() === $other->value();
    }
}
