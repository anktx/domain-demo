<?php

declare(strict_types=1);

namespace mss\Core\Shared\Exception;

final class WrongIntervalException extends DomainException
{
    public static function range(int|float $from, int|float $till): self
    {
        return new self(sprintf('Wrong interval %d-%d', $from, $till));
    }
}
