<?php

declare(strict_types=1);

/**
 * Bridge bundle for legacy projects
 */
namespace gertvdb\LegacyBridgeBundle;

use Composer\Autoload\ClassLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use gertvdb\LegacyBridgeBundle\DependencyInjection\Compiler\KernelConfigurationPass;
use gertvdb\LegacyBridgeBundle\DependencyInjection\Compiler\LoaderInjectorPass;
use gertvdb\LegacyBridgeBundle\DependencyInjection\Compiler\ReplaceRouterPass;
use gertvdb\LegacyBridgeBundle\DependencyInjection\LegacyBridgeBundleExtension;

/**
 * Class LegacyBridgeBundle
 *
 * @package gertvdb\LegacyBridgeBundle
 */
class LegacyBridgeBundle extends Bundle
{

    /**
     * @var ?ClassLoader
     */
    private $loader;

    /**
     * @param ClassLoader|null $loader
     */
    public function __construct(ClassLoader $loader = NULL)
    {
        $this->loader = $loader;

    }

    /**
     * Builds the bundle.
     *
     * It is only ever called once when the cache is empty.
     *
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function build(ContainerBuilder $container)
    {
        // The loader can be null when clearing the cache.
        if (NULL !== $this->loader) {
            $container->addCompilerPass(new LoaderInjectorPass());
        }

        $container->addCompilerPass(new KernelConfigurationPass());
        $container->addCompilerPass(new ReplaceRouterPass());

    }

    /**
     * Get the containerExtension.
     *
     * @return LegacyBridgeBundleExtension
     */
    public function getContainerExtension(): LegacyBridgeBundleExtension
    {
        return new LegacyBridgeBundleExtension();

    }

}
