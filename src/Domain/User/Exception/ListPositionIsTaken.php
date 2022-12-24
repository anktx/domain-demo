<?php

declare(strict_types=1);

namespace mss\Core\Domain\User\Exception;

use mss\Core\Shared\Exception\DomainException;

class ListPositionIsTaken extends DomainException
{
    public static function create(int $position): static
    {
        return static::msg(sprintf('Position `%d` is already taken', $position));
    }
}
