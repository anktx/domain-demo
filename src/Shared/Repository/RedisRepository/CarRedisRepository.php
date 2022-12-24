<?php

declare(strict_types=1);

namespace mss\Core\Shared\Repository\RedisRepository;

use mss\Core\Contract\Repository\CarRepositoryInterface;
use mss\Core\Domain\Car\Car;
use mss\Core\Source\Json\Builder\JsonCarBuilder;
use mss\Core\Source\Json\Exporter\JsonCarExporter;

class CarRedisRepository extends AbstractRedisRepository implements CarRepositoryInterface
{
    public function getById(int $carId): Car
    {
        $json = $this->read($carId);

        return JsonCarBuilder::load($json)->build();
    }

    public function persist(Car $car): void
    {
        $json = JsonCarExporter::load($car)->export();

        $this->save($car->id()->value(), $json);
    }

    public function findByIds(int ...$carIds): array
    {
        return $this->mapJsonToCar($this->multiRead(...$carIds));
    }

    public function findAll(): \Generator
    {
        foreach ($this->readAll() as $json) {
            yield JsonCarBuilder::load($json)->build();
        }
    }

    /**
     * @param string[] $jsonArr
     * @return Car[]
     */
    protected function mapJsonToCar(array $jsonArr): array
    {
        return array_map(fn (string $json) => JsonCarBuilder::load($json)->build(), $jsonArr);
    }
}
