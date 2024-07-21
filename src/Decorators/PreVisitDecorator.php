<?php

namespace Thrashzone13\Visitor\Decorators;

use Thrashzone13\Visitor\Contracts\DecoratorInterface;
use Thrashzone13\Visitor\Contracts\HandlerInterface;

class PreVisitDecorator implements DecoratorInterface
{
    private HandlerInterface $handler;

    private \Closure $preVisit;

    public function __construct(HandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    public function add(\Closure $closure): HandlerInterface
    {
        return $this->handler->add($closure);
    }

    public function setPreVisit(\Closure $preVisit): HandlerInterface
    {
        $this->preVisit = $preVisit;
        return $this;
    }

    public function visit(object $visitable): mixed
    {
        ($this->preVisit)($visitable);
        return $this->handler->visit($visitable);
    }
}
