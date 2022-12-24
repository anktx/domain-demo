<?php

declare(strict_types=1);

namespace mss\Core\Shared\Exception;

class ItemNotFoundException extends \Exception
{
    public static function create(string $repo, int $id): self
    {
        return new self(sprintf('Item id=`%d` not found in repo `%s`', $id, $repo));
    }
}
