<?php

namespace Delirius\PageFieldInherit;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DeliriusPageFieldInheritBundle extends Bundle
{
    public function getPath(): string{
        return \dirname(__DIR__);
    }
}
