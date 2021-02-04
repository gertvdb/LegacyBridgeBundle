<?php

declare(strict_types=1);

namespace gertvdb\LegacyBridgeBundle\DependencyInjection\Compiler;

use Composer\Autoload\ClassLoader;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class LoaderInjectorPass
 *
 * @package gertvdb\LegacyBridgeBundle\DependencyInjection\Compiler
 */
class LoaderInjectorPass implements CompilerPassInterface
{

    /**
     * @var ClassLoader
     */
    private $loader;

    /**
     * @param ClassLoader $loader
     */
    public function __construct(ClassLoader $loader)
    {
        $this->loader = $loader;

    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        // Inject composer.loader into tagged "loader_aware" services
        $taggedServices = $container->findTaggedServiceIds('loader_aware');
        foreach ($taggedServices as $id => $attributes) {
            $container->getDefinition($id)->addMethodCall('setLoader', [new Reference('composer.loader')]);
        }

    }


}
