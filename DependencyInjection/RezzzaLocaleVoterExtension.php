<?php

namespace Rezzza\LocaleVoterBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * RezzzaLocaleVoterExtension
 *
 * @uses Extension
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class RezzzaLocaleVoterExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $config    = $processor->processConfiguration(new Configuration(), $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));
        $loader->load('decision_manager.xml');
        $loader->load('voters.xml');

        $strategy = $config['strategy'];
        if ('request' === $strategy) {
            $loader->load('strategy_request.xml');
        }

        $decisionManagerDefinition = $container->getDefinition('rezzza.locale_voter.locale_decision_manager');
        $decisionManagerDefinition->addArgument($config['voters']);
        $decisionManagerDefinition->addArgument($config['locales']);
        $decisionManagerDefinition->addArgument($config['default_locale']);
    }
}
