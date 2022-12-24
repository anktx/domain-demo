<?php

declare(strict_types=1);

namespace mss\Core\Domain\User\Event;

use mss\Core\Shared\Domain\Bus\Event\EventCreator;

final class UserPasswordChangedEvent extends AbstractUserEvent
{
    public function __construct(
        int $unixtime,
        EventCreator $creator,
        int $userId,
        public readonly string $newPassword,
    ) {
        parent::__construct($unixtime, $creator, $userId);
    }

    public static function create(int $userId, string $newPassword): static
    {
        return new static(
            (int) date('U'),
            EventCreator::web,
            $userId,
            $newPassword,
        );
    }

    public function jsonSerialize(bool $showPassword = true): array
    {
        return parent::jsonSerialize() + ($showPassword ? [
            'newPassword' => $this->newPassword,
        ] : []);
    }
}
