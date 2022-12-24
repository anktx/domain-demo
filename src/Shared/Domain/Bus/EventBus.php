<?php

declare(strict_types=1);

namespace mss\Core\Shared\Domain\Bus;

use mss\Core\Shared\Domain\Bus\Event\DomainEventInterface;

class EventBus extends AbstractBus
{
    public function publish(DomainEventInterface ...$event): void
    {
        $this->dispatch(...$event);
    }
}
