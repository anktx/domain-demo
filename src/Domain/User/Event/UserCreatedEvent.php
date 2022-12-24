<?php

declare(strict_types=1);

namespace mss\Core\Domain\User\Event;

use mss\Core\Shared\Domain\Bus\Event\EventCreator;

final class UserCreatedEvent extends AbstractUserEvent
{
    public function __construct(
        int $unixtime,
        EventCreator $creator,
        int $userId,
        public readonly ?int $payerId,
        public readonly string $login,
        public readonly string $password,
        public readonly int $access,
        public readonly string $calcParams,
    ) {
        parent::__construct($unixtime, $creator, $userId);
    }

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            'payerId' => $this->payerId,
            'login' => $this->login,
            'password' => $this->password,
            'access' => $this->access,
            'calcParams' => $this->calcParams,
        ];
    }
}
