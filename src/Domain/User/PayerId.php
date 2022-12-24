<?php

declare(strict_types=1);

namespace mss\Core\Domain\User;

use mss\Core\Shared\Exception\DomainException;

class PayerId
{
    protected function __construct(
        protected readonly ?int $value,
    ) {
        if ($this->value < 0) {
            throw DomainException::msg(sprintf('Wrong payerId=`%d`', $this->value));
        }
    }

    public static function create(?int $value): self
    {
        return new self($value);
    }

    public function value(): ?int
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }
}
