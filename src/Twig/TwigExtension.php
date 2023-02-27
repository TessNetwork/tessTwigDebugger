<?php

namespace TessNetwork\TwigDebugger\Twig;

use Twig\Extension\AbstractExtension;

class TwigExtension extends AbstractExtension
{
    public function getNodeVisitors(): array
    {
        return [new DebuggerNodeVisitor()];
    }
}
