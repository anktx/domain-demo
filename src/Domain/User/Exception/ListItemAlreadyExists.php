<?php

declare(strict_types=1);

namespace mss\Core\Domain\User\Exception;

use mss\Core\Shared\Exception\DomainException;

class ListItemAlreadyExists extends DomainException
{
    public static function create(int $id): static
    {
        return static::msg(sprintf('List item `%d` already exist', $id));
    }
}
