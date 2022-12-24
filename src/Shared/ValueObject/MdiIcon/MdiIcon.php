<?php

declare(strict_types=1);

namespace mss\Core\Shared\ValueObject\MdiIcon;

class MdiIcon implements \JsonSerializable
{
    final public function __construct(
        protected IconName $name,
        protected IconScale $scale,
    ) {
    }

    public static function create(string $name, float $scale): static
    {
        return new static(
            IconName::create($name),
            IconScale::create($scale),
        );
    }

    public static function createDefault(): static
    {
        return self::create('mdi-car', 1);
    }

    public function name(): IconName
    {
        return $this->name;
    }

    public function scale(): IconScale
    {
        return $this->scale;
    }

    public function equals(self $other): bool
    {
        return $this->name()->value() === $other->name()->value() && $this->scale()->value() === $other->scale()->value();
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name()->value(),
            'coef' => $this->scale()->value(),
        ];
    }
}
