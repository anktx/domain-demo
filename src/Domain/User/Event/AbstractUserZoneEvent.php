<?php

declare(strict_types=1);

namespace mss\Core\Domain\User\Event;

use mss\Core\Domain\Zone\Zone;
use mss\Core\Shared\Domain\Bus\Event\EventCreator;

abstract class AbstractUserZoneEvent extends AbstractUserEvent
{
    final public function __construct(
        int $unixtime,
        EventCreator $creator,
        int $userId,
        protected readonly int $zoneId,
    ) {
        parent::__construct($unixtime, $creator, $userId);
    }

    public static function create(int $userId, Zone $zone): static
    {
        return new static(
            (int) date('U'),
            EventCreator::web,
            $userId,
            $zone->id()->value(),
        );
    }

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            'zoneId' => $this->zoneId,
        ];
    }
}
