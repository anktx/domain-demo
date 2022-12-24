<?php

declare(strict_types=1);

namespace mss\Core\Shared\Repository\RedisRepository;

use mss\Core\Contract\Repository\UserRepositoryInterface;
use mss\Core\Domain\User\User;
use mss\Core\Source\Json\Builder\JsonUserBuilder;
use mss\Core\Source\Json\Exporter\JsonUserExporter;

class UserRedisRepository extends AbstractRedisRepository implements UserRepositoryInterface
{
    public function __construct(mixed $redis, string $key)
    {
        parent::__construct($redis, $key);
    }

    public function getById(int $userId): User
    {
        $json = $this->read($userId);

        $userBuilder = JsonUserBuilder::load($json);

        return $userBuilder->build();
    }

    public function persist(User $user): void
    {
        $json = JsonUserExporter::load($user)->export();

        $this->save($user->id()->value(), $json);
    }
}
