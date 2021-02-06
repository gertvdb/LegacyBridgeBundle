<?php

declare(strict_types=1);

namespace gertvdb\LegacyBridgeBundle\DependencyInjection\Compiler;

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
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @return void
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
