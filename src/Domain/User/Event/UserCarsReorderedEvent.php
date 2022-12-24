<?php

declare(strict_types=1);

namespace mss\Core\Domain\User\Event;

use mss\Core\Shared\Domain\Bus\Event\EventCreator;

final class UserCarsReorderedEvent extends AbstractUserEvent
{
    /**
     * @param int[] $carIds
     */
    public function __construct(
        int $unixtime,
        EventCreator $creator,
        int $userId,
        public readonly array $carIds,
    ) {
        parent::__construct($unixtime, $creator, $userId);
    }

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            'carIds' => $this->carIds,
        ];
    }
}
