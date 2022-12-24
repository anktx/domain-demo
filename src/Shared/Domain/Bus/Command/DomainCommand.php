<?php

declare(strict_types=1);

namespace mss\Core\Shared\Domain\Bus\Command;

class DomainCommand implements DomainCommandInterface
{
    protected int $dt;

    public function __construct()
    {
        $this->dt = (int) date('U');
    }
}
