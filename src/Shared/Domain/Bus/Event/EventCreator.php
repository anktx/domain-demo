<?php

declare(strict_types=1);

namespace mss\Core\Shared\Domain\Bus\Event;

enum EventCreator: string
{
    case server = 'server';
    case web = 'web';
    case api = 'api';
}
