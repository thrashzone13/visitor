<?php

declare(strict_types=1);

namespace Thrashzone13\Visitor\Decorators;

use Thrashzone13\Visitor\Contracts\DecoratorInterface;
use Thrashzone13\Visitor\Contracts\HandlerInterface;

abstract class AbstractVisitDecorator implements DecoratorInterface
{
    protected HandlerInterface $handler;

    public function __construct(HandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    public function add(callable $callable): HandlerInterface
    {
        return $this->handler->add($callable);
    }

    public function getVisitors(): array
    {
        return $this->handler->getVisitors();
    }
}
