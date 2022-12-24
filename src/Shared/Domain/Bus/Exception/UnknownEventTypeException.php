<?php

declare(strict_types=1);

namespace mss\Core\Shared\Domain\Bus\Exception;

final class UnknownEventTypeException extends \Exception
{
    public static function create(string $type): static
    {
        return new static(sprintf('Unknown event type `%s`', $type));
    }
}
