<?php

declare(strict_types=1);

namespace Thrashzone13\Visitor\Exceptions;

class VisitorParameterCountException extends \Exception
{
    public function __construct(int $providedParameterCount)
    {
        parent::__construct("Exactly one parameter expected, {$providedParameterCount} provided");
    }
}
