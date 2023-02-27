<?php

namespace TessNetwork\TwigDebugger\Twig;

use TessNetwork\TwigDebugger\Twig\Node\CommentNode;
use Twig\Environment;
use Twig\Node\BlockNode;
use Twig\Node\BodyNode;
use Twig\Node\Node;
use Twig\NodeVisitor\NodeVisitorInterface;

class DebuggerNodeVisitor implements NodeVisitorInterface
{
    public function enterNode(Node $node, Environment $env): Node
    {
        return $node;
    }

    public function leaveNode(Node $node, Environment $env): ?Node
    {
        if ($node instanceof BlockNode) {
            $node->setNode('body', new BodyNode([
                new CommentNode(sprintf('block %s in %s',
                    $node->getAttribute('name'),
                    $node->getSourceContext()->getName())),
                $node->getNode('body'),
                new CommentNode(sprintf('enblock %s in %s',
                    $node->getAttribute('name'),
                    $node->getSourceContext()->getName())),
            ]));
        }
        return $node;
    }

    public function getPriority(): int
    {
        return 0;
    }
}
