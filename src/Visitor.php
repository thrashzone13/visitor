<?php

namespace Thrashzone13\Visitor;

use Closure;
use ReflectionFunction;

class Visitor
{
    private array $visitors = [];

    private ?Closure $default = null;

    public function add(\Closure $closure): self
    {
        $reflectionFunction = new ReflectionFunction($closure);
        $firstParameter = $reflectionFunction->getParameters()[0];
        $this->visitors[$firstParameter->getType()->getName()] = $closure;

        return $this;
    }

    public function default(\Closure $closure): self
    {
        $this->default = $closure;

        return $this;
    }

    public function visit(object $visitable):mixed
    {
        $className = get_class($visitable);

        if (!isset($this->visitors[$className])) {
            if (null !== $this->default) {
                $visitor = $this->default;
            } else{
                     throw new \Exception("No visitor found for $className");
            }
        } else {
            $visitor = $this->visitors[$className]; 
        }

        return $visitor($visitable);
    }
}