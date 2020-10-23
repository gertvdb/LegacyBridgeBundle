<?php
/**
 * Replace router pass
 */
namespace Tactics\LegacyBridgeBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ReplaceRouterPass
 */
class ReplaceRouterPass implements CompilerPassInterface
{

    /**
     * Process container.
     *
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container The container builder.
     *
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        // When our router service is defined we replace the default router listener.
        if ($container->hasDefinition('legacy_bridge_bundle.router_listener') === TRUE) {
            // First get te default router_listener.
            $routerListener = $container->getDefinition('router_listener');

            // Then get our custom route listener and inject the default route listener.
            $definition = $container->getDefinition('legacy_bridge_bundle.router_listener');
            $definition->replaceArgument(0, $routerListener);

            // Remap the route_listener service to our custom route listener.
            $container->setAlias('router_listener', 'legacy_bridge_bundle.router_listener');
        }

    }//end process()

}//end class
