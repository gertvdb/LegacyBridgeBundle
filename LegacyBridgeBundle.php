<?php
/**
 * Bridge bundle for legacy projects
 */
namespace Tactics\LegacyBridgeBundle;

use Composer\Autoload\ClassLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tactics\LegacyBridgeBundle\DependencyInjection\Compiler\KernelConfigurationPass;
use Tactics\LegacyBridgeBundle\DependencyInjection\Compiler\LoaderInjectorPass;
use Tactics\LegacyBridgeBundle\DependencyInjection\Compiler\ReplaceRouterPass;
use Tactics\LegacyBridgeBundle\DependencyInjection\LegacyBridgeBundleExtension;

/**
 * Class LegacyBridgeBundle
 *
 * @package Tactics\LegacyBridgeBundle
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
    public function __construct(ClassLoader $loader = null)
    {
        $this->loader = $loader;
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        // The loader can be null when clearing the cache.
        if (null !== $this->loader) {
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
