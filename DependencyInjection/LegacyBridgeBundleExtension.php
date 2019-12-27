<?php

/**
 * SF5 bridge
 */
namespace Tactics\LegacyBridgeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;


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

        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.xml');
        

        // Register composer class loader.
        $container->register('composer.loader', 'Composer\Autoload\ClassLoader');

    }//end load()


}
