<?php

declare(strict_types=1);

namespace gertvdb\LegacyBridgeBundle\DependencyInjection\Compiler;

use gertvdb\LegacyBridgeBundle\Configuration\Option;
use gertvdb\LegacyBridgeBundle\DependencyInjection\ContainerInvalidArgumentTypeException;
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
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter(Option::OPTION_LEGACY_KERNEL_ID)) {
            return;
        }

        if (!is_string($container->getParameter(Option::OPTION_LEGACY_KERNEL_ID))) {
            throw new ContainerInvalidArgumentTypeException(
                sprintf(
                    'Container parameter %s needs to be a string',
                    Option::OPTION_LEGACY_KERNEL_ID
                )
            );
        }

        $kernelId = $container->getParameter(Option::OPTION_LEGACY_KERNEL_ID);
        $container->setAlias('legacy_bridge_bundle.legacy_kernel', $kernelId);

        $kernelOptions = [];
        if ($container->hasParameter(Option::OPTION_LEGACY_KERNEL_OPTIONS)) {
            if (!is_array($container->getParameter(Option::OPTION_LEGACY_KERNEL_OPTIONS))) {
                throw new ContainerInvalidArgumentTypeException(
                    sprintf(
                        'Container parameter %s needs to be an array',
                        Option::OPTION_LEGACY_KERNEL_OPTIONS
                    )
                );
            }

            $kernelOptions = $container->getParameter(Option::OPTION_LEGACY_KERNEL_OPTIONS);
        }

        if (empty($kernelOptions) === FALSE) {
            $definition = $container->findDefinition($kernelId);
            $definition->addMethodCall('setOptions', [$kernelOptions]);
        }

        $classLoaderId = $this->getClassLoaderId($container);
        if ($classLoaderId !== NULL) {
            $definition = $container->findDefinition($kernelId);
            $definition->addMethodCall('setClassLoader', [new Reference($classLoaderId)]);
        }

    }

    /**
     * Get classloader id.
     *
     * @param ContainerBuilder $container
     *
     * @return string|null
     */
    private function getClassLoaderId(ContainerBuilder $container): ?string
    {
        if ($container->hasParameter(Option::OPTION_LEGACY_KERNEL_CLASS_LOADER_ID)) {
            if (!is_string($container->getParameter(Option::OPTION_LEGACY_KERNEL_CLASS_LOADER_ID))) {
                throw new ContainerInvalidArgumentTypeException(
                    sprintf(
                        'Container parameter %s needs to be a string',
                        Option::OPTION_LEGACY_KERNEL_CLASS_LOADER_ID
                    )
                );
            }

            return $container->getParameter(Option::OPTION_LEGACY_KERNEL_CLASS_LOADER_ID);
        }

        return NULL;

    }//end getClassLoaderId()


}
