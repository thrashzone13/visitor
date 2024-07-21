<?php

declare(strict_types=1);

namespace Thrashzone13\Visitor;

use Thrashzone13\Visitor\Contracts\HandlerInterface;
use Thrashzone13\Visitor\Exceptions\VisitorNotFoundException;

class Visitor implements HandlerInterface
{
    private array $visitors = [];

    public function add(\Closure $closure): self
    {
        $reflectionFunction = new \ReflectionFunction($closure);
        $firstParameter = $reflectionFunction->getParameters()[0];
        $this->visitors[$firstParameter->getType()->getName()] = $closure;

        return $this;
    }

    public function visit(object $visitable): mixed
    {
        $className = get_class($visitable);

        if (isset($this->visitors[$className])) {
            return $this->visitors[$className]($visitable);
        }

        throw new VisitorNotFoundException($className);
    }
}
