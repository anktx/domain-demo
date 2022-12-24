<?php

declare(strict_types=1);

namespace mss\Core\Contract\Repository;

use mss\Core\Domain\User\User;
use mss\Core\Shared\Exception\ItemNotFoundException;

interface UserRepositoryInterface
{
    /**
     * @throws ItemNotFoundException
     */
    public function getById(int $userId): User;

    public function persist(User $user): void;
}
