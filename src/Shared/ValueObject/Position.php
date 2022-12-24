<?php

declare(strict_types=1);

namespace mss\Core\Shared\ValueObject;

use mss\Core\Shared\Exception\DomainException;

class Position
{
    protected function __construct(
        protected readonly float $lat,
        protected readonly float $lng,
    ) {
        if (abs($this->lat) >= 90) {
            throw DomainException::msg(sprintf('Wrong lat=`%f`', $this->lat));
        }
        if (abs($this->lng) >= 180) {
            throw DomainException::msg(sprintf('Wrong lng=`%f`', $this->lng));
        }
    }

    public static function create(float $lat, float $lng, int $digits = 6): self
    {
        return new self(
            round($lat, $digits),
            round($lng, $digits),
        );
    }

    /**
     * @param array{float,float} $position
     */
    public static function createFromArray(array $position, int $digits = 6): self
    {
        return self::create($position[0], $position[1], $digits);
    }

    public function lat(): float
    {
        return $this->lat;
    }

    public function lng(): float
    {
        return $this->lng;
    }

    /**
     * @return array{float,float}
     */
    public function asArray(): array
    {
        return [$this->lat(), $this->lng()];
    }
}
