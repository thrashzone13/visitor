<?php

declare(strict_types=1);

namespace Thrashzone13\Visitor\Exceptions;

class VisitorParameterTypeAmbiguousException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Type of the expected parameter is not defined");
    }
}
