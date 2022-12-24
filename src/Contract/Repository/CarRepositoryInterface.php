<?php

declare(strict_types=1);

namespace mss\Core\Contract\Repository;

use mss\Core\Domain\Car\Car;
use mss\Core\Shared\Exception\ItemNotFoundException;

interface CarRepositoryInterface
{
    /**
     * @throws ItemNotFoundException
     */
    public function getById(int $carId): Car;

    /**
     * @return Car[]
     */
    public function findByIds(int ...$carIds): array;

    /**
     * @return Car[]|\Generator
     */
    public function findAll(): \Generator;

    public function persist(Car $car): void;
}
