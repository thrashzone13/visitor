<?php

declare(strict_types=1);

namespace Thrashzone13\Visitor\Decorators;

use Thrashzone13\Visitor\Exceptions\VisitorNotFoundException;

class InterfaceAwareVisitDecorator extends AbstractVisitDecorator
{
    public function visit(object $visitable): mixed
    {
        try {
            return $this->handler->visit($visitable);
        } catch (VisitorNotFoundException $exception) {
            $visitors = $this->getVisitors();
            $matchingInterfaces = array_intersect_key(class_implements($visitable), $visitors);
            if (count($matchingInterfaces) > 0) {
                foreach ($matchingInterfaces as $interfaceName) {
                    $result = $visitors[$interfaceName]($visitable);
                    if (null !== $result) {
                        $visitable = $result;
                    }
                }
                return $visitable;
            } else {
                throw $exception;
            }
        }
    }
}
