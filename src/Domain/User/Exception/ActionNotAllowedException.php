<?php

declare(strict_types=1);

namespace mss\Core\Domain\User\Exception;

use mss\Core\Domain\User\Action;
use mss\Core\Shared\Exception\DomainException;

class ActionNotAllowedException extends DomainException
{
    public static function action(Action $right): self
    {
        return new self(sprintf('Not authorized to `%s`', $right->name));
    }
}
