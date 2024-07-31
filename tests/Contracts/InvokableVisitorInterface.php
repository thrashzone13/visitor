<?php

namespace Thrashzone13\Visitor\Tests\Contracts;

interface InvokableVisitorInterface
{
    public function __invoke(VisitableInterface $param);
}