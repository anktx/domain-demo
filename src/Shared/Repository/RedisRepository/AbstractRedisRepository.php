<?php

declare(strict_types=1);

namespace mss\Core\Shared\Repository\RedisRepository;

use mss\Core\Shared\Exception\ItemNotFoundException;

abstract class AbstractRedisRepository
{
    /**
     * @param \Redis $redis
     */
    public function __construct(
        protected readonly mixed $redis,
        protected readonly string $key,
    ) {
    }

    protected function save(int $id, string $json): void
    {
        $this->redis->hSet($this->key, (string) $id, $json);
    }

    protected function read(int $id): string
    {
        $rst = $this->redis->hGet($this->key, (string) $id);

        if ($rst === false) {
            throw ItemNotFoundException::create(__CLASS__, $id);
        }

        return $rst;
    }

    /**
     * @return string[]
     */
    protected function multiRead(int ...$ids): array
    {
        return $this->redis->hMGet($this->key, array_map(fn (int $id) => (string) $id, $ids));
    }

    /**
     * @return string[]
     */
    protected function readAll(): array
    {
        return $this->redis->hGetAll($this->key);
    }
}
