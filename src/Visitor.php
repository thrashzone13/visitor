<?php

declare(strict_types=1);

namespace Thrashzone13\Visitor;

use Thrashzone13\Visitor\Contracts\HandlerInterface;
use Thrashzone13\Visitor\Exceptions\VisitorNotFoundException;
use Thrashzone13\Visitor\Exceptions\VisitorParameterCountException;
use Thrashzone13\Visitor\Exceptions\VisitorParameterTypeAmbiguousException;

class Visitor implements HandlerInterface
{
    private array $visitors = [];

    public function add(callable $callable): self
    {
        if (is_object($callable) && method_exists($callable, '__invoke')) {
            $reflectionClass = new \ReflectionMethod($callable, '__invoke');
        } else {
            $reflectionClass = new \ReflectionFunction($callable);
        }

        if ($reflectionClass->getNumberOfParameters() !== 1) {
            throw new VisitorParameterCountException(
                $reflectionClass->getNumberOfParameters()
            );
        }

        $firstParameter = $reflectionClass->getParameters()[0];

        if (null === $firstParameter->getType()) {
            throw new VisitorParameterTypeAmbiguousException();
        }

        $firstParameterTypeName = $firstParameter->getType()->getName();
        if (class_exists($firstParameterTypeName)) {
            $firstParameterReflectionClass = new \ReflectionClass($firstParameterTypeName);
            if ($firstParameterReflectionClass->getParentClass()) {
                $this->visitors[$firstParameterReflectionClass->getParentClass()->getName()] = $callable;
            } else {
                $this->visitors[$firstParameterTypeName] = $callable;
            }
        } else {
            $this->visitors[$firstParameterTypeName] = $callable;
        }

        return $this;
    }

    public function getVisitors(): array
    {
        return $this->visitors;
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
