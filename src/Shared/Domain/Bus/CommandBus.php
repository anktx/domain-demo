<?php

declare(strict_types=1);

namespace mss\Core\Shared\Domain\Bus;

use mss\Core\Shared\Domain\Bus\Command\DomainCommandInterface;

class CommandBus extends AbstractBus
{
    public function publish(DomainCommandInterface ...$command): void
    {
        $this->dispatch(...$command);
    }
}
