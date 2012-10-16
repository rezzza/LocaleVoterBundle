<?php

namespace Rezzza\LocaleVoterBundle\Locale;

use Rezzza\LocaleVoterBundle\Locale\Voter\VoterInterface;
use Rezzza\LocaleVoterBundle\Locale\Context\LocaleContextInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * LocaleDecisionManager
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class LocaleDecisionManager
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var array<string>
     */
    private $voters = array();

    /**
     * @var array<string>
     */
    private $supportedLocales = array();

    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * @param array $supportedLocales supportedLocales
     * @param mixed $defaultLocale    defaultLocale
     */
    public function __construct(ContainerInterface $container, array $voters, array $supportedLocales, $defaultLocale)
    {
        $this->supportedLocales = $supportedLocales;
        $this->defaultLocale    = $defaultLocale;
        $this->voters           = $voters;
        $this->container        = $container;
    }

    /**
     * Enter on voter until one return a locale.
     * When a voter return a culture, we'll return it to strategy.
     */
    public function decide(LocaleContextInterface $context)
    {
        foreach ($this->voters as $voter) {
            $voterService = $this->getVoterService($voter);

            $voterService->setSupportedLocales($this->supportedLocales);
            $locale       = $voterService->vote($context);

            if ($locale && in_array($locale, $this->supportedLocales)) {
                return $locale;
            }
        }

        return $this->defaultLocale;
    }

    /**
     * @param string $voter voter
     *
     * @return VoterInterface
     */
    protected function getVoterService($voter)
    {
        $voterService = $this->container->get($voter);
        if (!$voterService instanceof VoterInterface) {
            throw new \LogicException(sprintf('Voter %s must implements VoterInterface', $voter));
        }

        return $voterService;
    }
}
