<?php

declare(strict_types=1);

namespace mss\Core\Source\Json\Exporter;

use mss\Core\Domain\User\User;

class JsonUserExporter
{
    final protected function __construct(
        protected readonly User $user,
    ) {
    }

    public static function load(User $user): static
    {
        return new static($user);
    }

    public function export(): string
    {
        return json_encode([
            'userId' => $this->user->id()->value(),
            'payerId' => $this->user->payerId()->value(),
            'login' => $this->user->login()->value(),
            'password' => $this->user->password()->value(),
            'rights' => $this->user->access()->value(),
            'calcParams' => $this->user->calcParams(),
            'carIds' => $this->user->carIds(),
            'zoneIds' => $this->user->zoneIds(),
        ], flags: JSON_THROW_ON_ERROR);
    }
}
