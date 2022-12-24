<?php

declare(strict_types=1);

namespace mss\Core\Shared\Domain\Bus\Exception;

final class EventFieldsRequiredException extends \Exception
{
    public static function unixtimeNotSet(): static
    {
        return new static('Unixtime not set');
    }

    public static function typeNotSet(): static
    {
        return new static('Event type not set');
    }

    public static function creatorNotSet(): static
    {
        return new static('Event creator not set');
    }
}
