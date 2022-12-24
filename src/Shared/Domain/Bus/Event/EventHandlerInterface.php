<?php

declare(strict_types=1);

namespace mss\Core\Shared\Domain\Bus\Event;

interface EventHandlerInterface
{
    public function __invoke(DomainEvent $e): void;
}
