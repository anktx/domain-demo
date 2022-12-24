<?php

declare(strict_types=1);

namespace mss\Core\Domain\User;

class Access
{
    protected function __construct(protected readonly int $value)
    {
    }

    public static function create(int $value): self
    {
        return new self($value);
    }

    public function allowed(Action $action): bool
    {
        return ($this->value | $action->value) === $this->value;
    }

    public function value(): int
    {
        return $this->value;
    }

    /**
     * @return array<Action::*>
     */
    public function actionEnums(): array
    {
        return array_filter(Action::cases(), fn (Action $a) => $this->allowed($a));
    }

    /**
     * @return string[]
     */
    public function actionNames(): array
    {
        return array_values(array_map(fn (Action $a) => $a->name, $this->actionEnums()));
    }

    public function equals(Access $other): bool
    {
        return $this->value() === $other->value();
    }
}
