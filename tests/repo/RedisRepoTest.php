<?php

declare(strict_types=1);

namespace tests\repo;

use mss\Core\Shared\Repository\RedisRepository\UserRedisRepository;
use tests\ApiTest;

class RedisRepoTest extends ApiTest
{
    protected UserRedisRepository $userRedisRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRedisRepository = new UserRedisRepository($this->redisClient, 'users');
    }

    public function testUserRepo()
    {
        $this->userRedisRepository->persist($this->user);

        $user = $this->userRedisRepository->getById($this->user->id()->value());

        $this->assertEquals($this->user, $user);
    }
}
