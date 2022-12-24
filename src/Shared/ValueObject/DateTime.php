<?php

declare(strict_types=1);

namespace mss\Core\Shared\ValueObject;

use DateTime as DateTimeNative;

class DateTime
{
    protected DateTimeNative $dt;

    protected function __construct(string $format, string $value)
    {
        $this->dt = DateTimeNative::createFromFormat($format, $value);
    }

    public static function createFromUnixtime(int $value): self
    {
        return new self('U', (string) $value);
    }

    public static function now(): self
    {
        return new self('U', date('U'));
    }

    public static function createFromFormat(string $format, string $value): self
    {
        return new self($format, $value);
    }

    public function unixTime(): int
    {
        return (int) $this->dt->format('U');
    }

    public function humanRead(string $format = 'Y-m-d H:i:s'): string
    {
        return $this->format($format);
    }

    public function format(string $format): string
    {
        return $this->dt->format($format);
    }
}
