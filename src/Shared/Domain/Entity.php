<?php

declare(strict_types=1);

namespace mss\Core\Shared\Domain;

use mss\Core\Shared\Domain\Bus\Command\DomainCommand;
use mss\Core\Shared\Domain\Bus\Event\DomainEvent;

abstract class Entity
{
    /**
     * @var DomainEvent[]
     */
    private array $domainEvents = [];

    /** @var DomainCommand[] */
    private array $domainCommands = [];

    /**
     * @return DomainEvent[]
     */
    final public function pullEvents(): array
    {
        $ret = $this->domainEvents;
        $this->domainEvents = [];

        return $ret;
    }

    /**
     * @return DomainCommand[]
     */
    final public function pullCommands(): array
    {
        $ret = $this->domainCommands;
        $this->domainCommands = [];

        return $ret;
    }

    final protected function recordEvent(DomainEvent ...$domainEvent): void
    {
        $this->domainEvents += $domainEvent;
    }

    final protected function recordCommand(DomainCommand ...$domainCommand): void
    {
        $this->domainCommands += $domainCommand;
    }
}
