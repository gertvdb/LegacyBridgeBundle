<?php

/**
 * SF5 bridge
 */
namespace Tactics\LegacyBridgeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 */
class LegacyBridgeBundleExtension extends Extension
{


    /**
     * Loads a specific configuration.
     *
     * @param array            $configs   The config array
     * @param ContainerBuilder $container The container builder
     *
     * @throws \Exception
     *
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        // Get the xml file loader.
        $loader = new Loader\XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        // Load the services.xml file.
        $loader->load('services.xml');

        // Register composer class loader.
        $container->register('composer.loader', 'Composer\Autoload\ClassLoader');

    }//end load()


}
