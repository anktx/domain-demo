<?php

declare(strict_types=1);

namespace mss\Core\Domain\User\Event;

use mss\Core\Domain\User\User;
use mss\Core\Shared\Domain\Bus\Event\EventCreator;

final class UserAccessChangedEvent extends AbstractUserEvent
{
    public function __construct(
        int $unixtime,
        EventCreator $creator,
        int $userId,
        public readonly int $access,
    ) {
        parent::__construct($unixtime, $creator, $userId);
    }

    public static function create(User $user): static
    {
        return new static(
            (int) date('U'),
            EventCreator::web,
            $user->id()->value(),
            $user->access()->value(),
        );
    }

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            'access' => $this->access,
        ];
    }
}
