<?php

namespace Thrashzone13\Visitor\Exceptions;
class VisitorNotFoundException extends \Exception
{
    public function __construct(string $className = "")
    {
        parent::__construct("No visitor found for class {$className}");
    }
}