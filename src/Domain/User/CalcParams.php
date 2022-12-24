<?php

declare(strict_types=1);

namespace mss\Core\Domain\User;

class CalcParams implements \JsonSerializable
{
    public const DEFAULT_SPEED_LIMIT = 90;
    public const DEFAULT_MIN_TEMP = 0;
    public const DEFAULT_MAX_TEMP = 20;

    final protected function __construct(
        protected readonly \stdClass $data,
    ) {
    }

    public static function create(array $data): static
    {
        return new static((object) $data);
    }

    /**
     * @return array<string,mixed>
     */
    public function jsonSerialize(): array
    {
        return (array) $this->data;
    }
}
