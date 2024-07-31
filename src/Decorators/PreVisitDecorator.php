<?php

declare(strict_types=1);

namespace Thrashzone13\Visitor\Decorators;

use Thrashzone13\Visitor\Contracts\HandlerInterface;

class PreVisitDecorator extends AbstractVisitDecorator
{
    private \Closure $preVisit;

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
