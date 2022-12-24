<?php

declare(strict_types=1);

namespace mss\Core\Shared\ValueObject\MdiIcon;

use mss\Core\Shared\Exception\DomainException;

class IconName
{
    protected function __construct(protected readonly string $value)
    {
        if (! preg_match('%^mdi-%', $this->value)) {
            throw DomainException::msg(sprintf('Wrong icon name=`%s`', $this->value));
        }
    }

    public static function create(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }
}
