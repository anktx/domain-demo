<?php

declare(strict_types=1);

namespace mss\Core\Domain\User\Event;

use mss\Core\Domain\Car\Car;
use mss\Core\Shared\Domain\Bus\Event\EventCreator;

abstract class AbstractUserCarEvent extends AbstractUserEvent
{
    final public function __construct(
        int $unixtime,
        EventCreator $creator,
        int $userId,
        public readonly int $carId,
        public readonly int $unitId,
    ) {
        parent::__construct($unixtime, $creator, $userId);
    }

    public static function create(int $userId, Car $car): static
    {
        return new static(
            (int) date('U'),
            EventCreator::web,
            $userId,
            $car->id()->value(),
            $car->unitId()->value(),
        );
    }

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            'carId' => $this->carId,
            'unitId' => $this->unitId,
        ];
    }
}
