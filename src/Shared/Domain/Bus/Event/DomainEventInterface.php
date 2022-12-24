<?php

declare(strict_types=1);

namespace mss\Core\Shared\Domain\Bus\Event;

interface DomainEventInterface extends \JsonSerializable
{
    public function unixtime(): int;

    public function creator(): EventCreator;

    public function type(): string;
}
