<?php

namespace TessNetwork\TwigDebugger\Twig\Node;

use Twig\Compiler;
use Twig\Node\Node;

class CommentNode extends Node
{
    /** @var string */
    private $text;

    public function __construct(string $text)
    {
        parent::__construct();
        $this->text = $text;
    }

    public function compile(Compiler $compiler)
    {
        $compiler
            ->write('echo ')
            ->string(sprintf("<!-- %s -->\n", $this->text))
            ->raw(";\n");
    }
}
