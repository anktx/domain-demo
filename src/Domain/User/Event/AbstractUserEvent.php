<?php

declare(strict_types=1);

namespace mss\Core\Domain\User\Event;

use mss\Core\Shared\Domain\Bus\Event\DomainEvent;
use mss\Core\Shared\Domain\Bus\Event\EventCreator;

abstract class AbstractUserEvent extends DomainEvent
{
    public function __construct(
        int $unixtime,
        EventCreator $creator,
        public readonly int $userId,
    ) {
        parent::__construct($unixtime, $creator);
    }

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            'userId' => $this->userId,
        ];
    }
}
