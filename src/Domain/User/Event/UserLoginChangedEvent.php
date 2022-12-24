<?php

declare(strict_types=1);

namespace mss\Core\Domain\User\Event;

use mss\Core\Shared\Domain\Bus\Event\EventCreator;

final class UserLoginChangedEvent extends AbstractUserEvent
{
    public function __construct(
        int $unixtime,
        EventCreator $creator,
        int $userId,
        public readonly string $newLogin,
    ) {
        parent::__construct($unixtime, $creator, $userId);
    }

    public static function create(int $userId, string $newLogin): static
    {
        return new static(
            (int) date('U'),
            EventCreator::web,
            $userId,
            $newLogin,
        );
    }

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            'newLogin' => $this->newLogin,
        ];
    }
}
