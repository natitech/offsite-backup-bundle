<?php

namespace Nati\OffsiteBackupBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('offsite_backup');

        $treeBuilder->getRootNode()
                    ->children()
                    ->scalarNode('aws_key')->defaultValue('%env(AWS_ACCESS_KEY_ID)%')->end()
                    ->scalarNode('aws_secret')->defaultValue('%env(AWS_SECRET_ACCESS_KEY)%')->end()
                    ->end();

        return $treeBuilder;
    }
}
