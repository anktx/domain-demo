<?php

declare(strict_types=1);

namespace mss\Core\Domain\User;

use mss\Core\Domain\User\Exception\ListItemAlreadyExists;
use mss\Core\Domain\User\Exception\ListPositionIsTaken;

abstract class AbstractIdsList implements \Countable
{
    /**
     * @param array<int,int> $items
     */
    final protected function __construct(protected array $items = [])
    {
    }

    public static function createEmpty(): static
    {
        return new static([]);
    }

    /**
     * @param array<int,int> $items
     */
    public static function create(array $items): static
    {
        ksort($items);

        return new static(array_values($items));
    }

    /**
     * @throws ListItemAlreadyExists
     * @throws ListPositionIsTaken
     */
    public function add(int $id, int $position): void
    {
        $this->assertPositionNotTaken($position);
        $this->assertNotAddedBefore($id);

        $this->items[$position] = $id;
    }

    public function contains(int $id): bool
    {
        return array_search($id, $this->items) !== false;
    }

    public function remove(int $id): void
    {
        array_splice($this->items, array_search($id, $this->items), 1);
    }

    /**
     * @return array<int,int>
     */
    public function items(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    protected function assertPositionNotTaken(int $position): void
    {
        if (array_key_exists($position, $this->items)) {
            throw ListPositionIsTaken::create($position);
        }
    }

    protected function assertNotAddedBefore(int $id): void
    {
        if ($this->contains($id)) {
            throw ListItemAlreadyExists::create($id);
        }
    }
}
