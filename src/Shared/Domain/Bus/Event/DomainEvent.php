<?php

declare(strict_types=1);

namespace mss\Core\Shared\Domain\Bus\Event;

abstract class DomainEvent implements DomainEventInterface
{
    public function __construct(
        public readonly int $unixtime,
        public readonly EventCreator $creator,
    ) {
    }

    final public function unixtime(): int
    {
        return $this->unixtime;
    }

    final public function creator(): EventCreator
    {
        return $this->creator;
    }

    final public function type(): string
    {
        return preg_replace('%Event$%', '', (new \ReflectionClass($this))->getShortName());
    }

    /**
     * @return array<string,mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'dt' => $this->unixtime,
            'type' => $this->type(),
            'creator' => $this->creator->name,
        ];
    }
}
