<?php

declare(strict_types=1);

namespace gertvdb\LegacyBridgeBundle\DependencyInjection\Compiler;

use Exception;
use gertvdb\LegacyBridgeBundle\Configuration\Option;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class KernelConfigurationPass
 *
 * @package gertvdb\LegacyBridgeBundle\DependencyInjection\Compiler
 */
class KernelConfigurationPass implements CompilerPassInterface
{


    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $kernelId      = $container->getParameter(Option::OPTION_LEGACY_KERNEL_ID);
        $kernelOptions = $container->getParameter(Option::OPTION_LEGACY_KERNEL_OPTIONS);
        $classLoaderId = $this->getClassLoaderId($container);
        $container->setAlias('legacy_bridge_bundle.legacy_kernel', $kernelId);

        if (empty($kernelOptions) === FALSE) {
            $definition = $container->findDefinition($kernelId);
            $definition->addMethodCall('setOptions', [$kernelOptions]);
        }

        if ($classLoaderId !== NULL) {
            $definition = $container->findDefinition($kernelId);
            $definition->addMethodCall('setClassLoader', [new Reference($classLoaderId)]);
        }

    }

    private function getClassLoaderId(ContainerBuilder $container)
    {
        try {
            return $container->getParameter(Option::OPTION_LEGACY_KERNEL_CLASS_LOADER_ID);
        } catch (Exception $exception) {
            return NULL;
        }

    }//end getClassLoaderId()


}
