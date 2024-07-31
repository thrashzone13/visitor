<?php

namespace Thrashzone13\Visitor\Tests;

use PHPUnit\Framework\TestCase;
use Thrashzone13\Visitor\Decorators\InterfaceAwareVisitDecorator;
use Thrashzone13\Visitor\Tests\Contracts\InvokableVisitorInterface;
use Thrashzone13\Visitor\Tests\Contracts\VisitableInterface;
use Thrashzone13\Visitor\Visitor;

class InvokableVisitorTest extends TestCase
{
    public function testPassingInvokableClassAsVisitor()
    {
        $invokableVisitorMock = $this->createMock(InvokableVisitorInterface::class);

        $invokableVisitorMock
            ->expects($this->once())
            ->method('__invoke')
            ->with($this->isInstanceOf(VisitableInterface::class));

        $visitableMock = $this->createMock(VisitableInterface::class);

        $visitor = new InterfaceAwareVisitDecorator(new Visitor());
        $visitor->add($invokableVisitorMock);
        $visitor->visit($visitableMock);
    }
}
