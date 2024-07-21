<?php

namespace Thrashzone13\Visitor\Decorators;

use Thrashzone13\Visitor\Contracts\DecoratorInterface;
use Thrashzone13\Visitor\Contracts\HandlerInterface;
use Thrashzone13\Visitor\Exceptions\VisitorNotFoundException;

class FallBackVisitDecorator implements DecoratorInterface
{
    private HandlerInterface $handler;

    private \Closure $fallBack;

    public function __construct(HandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    public function add(\Closure $closure): HandlerInterface
    {
        return $this->handler->add($closure);
    }

    public function setFallBack(\Closure $fallBack): HandlerInterface
    {
        $this->fallBack = $fallBack;
        return $this;
    }

    public function visit(object $visitable): mixed
    {
        try {
            return $this->handler->visit($visitable);
        } catch (VisitorNotFoundException $exception) {
            return ($this->fallBack)($visitable);
        }
    }
}
