<?php

declare(strict_types=1);

namespace Thrashzone13\Visitor\Decorators;

use Thrashzone13\Visitor\Contracts\HandlerInterface;
use Thrashzone13\Visitor\Exceptions\VisitorNotFoundException;

class FallBackVisitDecorator extends AbstractVisitDecorator
{
    private \Closure $fallBack;

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
