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
     * @var \Composer\Autoload\ClassLoader
     */
    private $loader;

    /**
     * @param ClassLoader $loader
     */
    public function __construct(ClassLoader $loader = NULL)
    {
        $this->loader = $loader;

    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        // The loader can be null when clearing the cache.
        if (NULL !== $this->loader) {
            $container->addCompilerPass(new LoaderInjectorPass($this->loader));
        }

        $container->addCompilerPass(new KernelConfigurationPass());
        $container->addCompilerPass(new ReplaceRouterPass());

    }

    public function getContainerExtension()
    {
        return new LegacyBridgeBundleExtension();

    }

}
