<?php

declare(strict_types=1);

namespace mss\Core\Domain\User\Exception;

use mss\Core\Shared\Exception\DomainException;

final class UserZoneNotFoundException extends DomainException
{
    public static function create(int $zoneId): static
    {
        return new static(sprintf('User zone id=`%d` not found', $zoneId));
    }
}
