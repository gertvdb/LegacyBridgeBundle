<?php

declare(strict_types=1);

namespace gertvdb\LegacyBridgeBundle\DependencyInjection;

use Composer\Autoload\ClassLoader;
use Exception;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 */
class LegacyBridgeBundleExtension extends Extension
{


    /**
     * Loads a specific configuration.
     *
     * @param array<mixed>     $configs   The config array
     * @param ContainerBuilder $container The container builder
     *
     * @throws Exception
     *
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new PhpFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('services.php');

        // Register composer class loader.
        $container->register('composer.loader', ClassLoader::class);

    }//end load()


}
