<?php

declare(strict_types=1);

namespace mss\Core\Domain\User\Exception;

use mss\Core\Shared\Exception\DomainException;

final class UserCarNotFoundException extends DomainException
{
    public static function create(int $carId): static
    {
        return new static(sprintf('User car id=`%d` not found', $carId));
    }
}
