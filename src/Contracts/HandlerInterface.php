<?php

declare(strict_types=1);

namespace Thrashzone13\Visitor\Contracts;

interface HandlerInterface
{
    public function add(\Closure $closure): self;

    public function visit(object $visitable): mixed;
}
