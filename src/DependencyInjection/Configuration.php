<?php

declare(strict_types=1);

namespace gertvdb\LegacyBridgeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 */
class Configuration implements ConfigurationInterface
{


    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('legacy_bridge_bundle');
        $rootNode    = $treeBuilder->getRootNode();

        $rootNode->children()->scalarNode('root_dir')->info('The path where the legacy app lives')->isRequired()->end()->arrayNode('legacy_kernel')->children()->scalarNode('id')->info('The legacy kernel id')->isRequired()->end()->arrayNode('options')->children()->scalarNode('application')->info('The legacy application')->end()->scalarNode('environment')->info('The environment')->end()->booleanNode('debug')->info('Whether to enable debug')->end()->end()->end();

        return $treeBuilder;

    }//end getConfigTreeBuilder()


}//end class
