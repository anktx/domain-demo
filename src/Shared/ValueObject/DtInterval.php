<?php

declare(strict_types=1);

namespace mss\Core\Shared\ValueObject;

use mss\Core\Shared\Exception\WrongIntervalException;

class DtInterval
{
    public function __construct(
        protected readonly DateTime $from,
        protected readonly DateTime $till,
    ) {
        if ($this->till->unixTime() < $this->from->unixTime()) {
            throw WrongIntervalException::range($this->from->unixTime(), $this->till->unixTime());
        }
    }

    public static function createFromUnixtime(int $from, int $till): self
    {
        return new self(DateTime::createFromUnixtime($from), DateTime::createFromUnixtime($till));
    }

    public function from(): DateTime
    {
        return $this->from;
    }

    public function till(): DateTime
    {
        return $this->till;
    }

    public function duration(): int
    {
        return $this->till()->unixTime() - $this->from->unixTime();
    }

    public function humanRead(string $format = 'Y-m-d H:i:s'): string
    {
        return sprintf('%s - %s', $this->from()->humanRead($format), $this->till()->humanRead($format));
    }
}
