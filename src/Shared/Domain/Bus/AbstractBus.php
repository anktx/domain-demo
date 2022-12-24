<?php

declare(strict_types=1);

namespace mss\Core\Shared\Domain\Bus;

use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlerDescriptor;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

abstract class AbstractBus
{
    private readonly MessageBus $bus;

    /**
     * @param callable[][]|HandlerDescriptor[][] $subscribers
     */
    public function __construct(array $subscribers)
    {
        $this->bus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlersLocator(
                        $subscribers,
                    )
                ),
            ]
        );
    }

    protected function dispatch(mixed ...$events): void
    {
        foreach ($events as $event) {
            try {
                $this->bus->dispatch($event);
            } catch (NoHandlerForMessageException) {
            }
        }
    }
}
