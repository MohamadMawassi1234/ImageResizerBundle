<?php

/**
 * Configuration class.
 */

namespace MyBundle\ImageResizerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('image_resizer');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('student')
                    ->children()
                        ->arrayNode('resized_image')
                            ->children()
                                ->scalarNode('width')->end()
                                ->scalarNode('height')->end()
                                ->scalarNode('quality')->end()
                                ->scalarNode('resize_by')->end()
                                ->scalarNode('location')->end()
                            ->end()
                        ->end()
                        ->arrayNode('thumbnail')
                            ->children()
                                ->scalarNode('width')->end()
                                ->scalarNode('height')->end()
                                ->scalarNode('quality')->end()
                                ->scalarNode('resize_by')->end()
                                ->scalarNode('location')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('course')
                    ->children()
                        ->arrayNode('resized_image')
                            ->children()
                                ->scalarNode('width')->end()
                                ->scalarNode('height')->end()
                                ->scalarNode('quality')->end()
                                ->scalarNode('resize_by')->end()
                                ->scalarNode('location')->end()
                            ->end()
                        ->end()
                        ->arrayNode('thumbnail')
                            ->children()
                                ->scalarNode('width')->end()
                                ->scalarNode('height')->end()
                                ->scalarNode('quality')->end()
                                ->scalarNode('resize_by')->end()
                                ->scalarNode('location')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('classes')
                    ->children()
                        ->arrayNode('resized_image')
                            ->children()
                                ->scalarNode('width')->end()
                                ->scalarNode('height')->end()
                                ->scalarNode('quality')->end()
                                ->scalarNode('resize_by')->end()
                                ->scalarNode('location')->end()
                            ->end()
                        ->end()
                        ->arrayNode('thumbnail')
                            ->children()
                                ->scalarNode('width')->end()
                                ->scalarNode('height')->end()
                                ->scalarNode('quality')->end()
                                ->scalarNode('resize_by')->end()
                                ->scalarNode('location')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('default')
                    ->children()
                        ->arrayNode('resized_image')
                            ->children()
                                ->scalarNode('width')->end()
                                ->scalarNode('height')->end()
                                ->scalarNode('quality')->end()
                                ->scalarNode('resize_by')->end()
                                ->scalarNode('location')->end()
                            ->end()
                        ->end()
                        ->arrayNode('thumbnail')
                            ->children()
                                ->scalarNode('width')->end()
                                ->scalarNode('height')->end()
                                ->scalarNode('quality')->end()
                                ->scalarNode('resize_by')->end()
                                ->scalarNode('location')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}