<?php

declare(strict_types=1);

namespace Thrashzone13\Visitor\Contracts;

interface DecoratorInterface extends HandlerInterface
{
    public function __construct(HandlerInterface $handler);
}
