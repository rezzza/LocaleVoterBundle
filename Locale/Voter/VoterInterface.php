<?php

namespace Rezzza\LocaleVoterBundle\Locale\Voter;

use Rezzza\LocaleVoterBundle\Locale\Context\LocaleContextInterface;

/**
 * VoterInterface
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
interface VoterInterface
{
    /**
     * Return the culture or null if it doesn't match.
     *
     * @return string|null
     */
    public function vote(LocaleContextInterface $context);

    /**
     * @param array $supportedLocales supportedLocales
     */
    public function setSupportedLocales(array $supportedLocales);
}
