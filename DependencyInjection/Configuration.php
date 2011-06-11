<?php

namespace Jackalope\Bundle\JackalopeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * This class contains the configuration information for the bundle
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
class Configuration
{
    /**
     * Generates the configuration tree.
     *
     * @return \Symfony\Component\DependencyInjection\Configuration\NodeInterface
     */
    public function getConfigTree()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('jackalope', 'array');

        $rootNode
            ->children()
                    ->scalarNode('transport')->isRequired()->defaultValue('doctrine')->end()
                    ->scalarNode('connection')->isRequired()->defaultValue('default')->end()
                    ->scalarNode('workspace')->isRequired()->defaultValue('default')->end()
                    ->scalarNode('user')->defaultValue('default')->end()
                    ->scalarNode('pass')->defaultValue('default')->end()
            ->end();

        return $treeBuilder->buildTree();
    }

}