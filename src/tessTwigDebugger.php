<?php

namespace TessNetwork\TwigDebugger;

use Shopware\Core\Framework\Plugin;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use TessNetwork\TwigDebugger\Twig\TwigExtension;

class tessTwigDebugger extends Plugin implements CompilerPassInterface
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass($this);
    }

    public function process(ContainerBuilder $container)
    {
        $container->setDefinition(TwigExtension::class, new Definition(TwigExtension::class));

        $twig = $container->getDefinition('twig');
        $twig->addMethodCall('addExtension', [
            new Reference(TwigExtension::class),
        ]);
    }
}
