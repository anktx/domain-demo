<?php

declare(strict_types=1);

namespace mss\Core\Shared\Domain\Bus\Command;

interface CommandHandlerInterface
{
    public function __invoke(DomainCommand $c): void;
}
