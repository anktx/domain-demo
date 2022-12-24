<?php

declare(strict_types=1);

namespace mss\Core\Shared\Domain\Bus\Listener;

use mss\Core\Shared\Domain\Bus\Event\DomainEvent;

interface ListenerInterface
{
    public function publish(DomainEvent $event): void;
}
