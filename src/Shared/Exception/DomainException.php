<?php

declare(strict_types=1);

namespace mss\Core\Shared\Exception;

class DomainException extends \Exception
{
    final protected function __construct(string $message = '', int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function msg(string $message): static
    {
        return new static($message);
    }
}
