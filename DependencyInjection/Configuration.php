<?php

namespace Rezzza\LocaleVoterBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 *
 * @uses ConfigurationInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('rezzza_locale_voter');

        $rootNode
            ->children()
                ->scalarNode('strategy')
                    ->example('request')
                ->end()
                ->scalarNode('default_locale')
                    ->isRequired()
                ->end()
                ->arrayNode('locales')
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                    ->prototype('scalar')
                    ->end()
                ->end()
                ->arrayNode('voters')
                    ->requiresAtLeastOneElement()
                    ->defaultValue(array(
                        'rezzza.locale_voter.request_parameter.voter',
                        'rezzza.locale_voter.accept_language.voter',
                    ))
                    ->prototype('scalar')
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }


}
