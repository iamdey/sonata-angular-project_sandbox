<?php

namespace Dey\Sonata\AngularAdminBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        //TODO inject new config param in sonata
        
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sonata_admin', 'array');
//
//        $rootNode
//            ->children()
//                ->arrayNode('templates')
//                    ->addDefaultsIfNotSet()
//                    ->children()
//                        ->scalarNode('angular_layout')->defaultValue('DeySonataAngularAdminBundle::standard_layout.html.twig')->cannotBeEmpty()->end()
//                    ->end()
//                ->end()
//            ->end()
//        ->end();
//
        return $treeBuilder;
    }
}
