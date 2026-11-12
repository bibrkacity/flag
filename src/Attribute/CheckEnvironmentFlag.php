<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class CheckEnvironmentFlag
{
    public function __construct(
        public string $paramName = 'AB'
    ) {}
}
