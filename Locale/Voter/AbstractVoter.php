<?php

namespace Rezzza\LocaleVoterBundle\Locale\Voter;

/**
 * AbstractVoter
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
abstract class AbstractVoter
{
    /**
     * @var array
     */
    protected $supportedLocales = array();

    /**
     * @param array $supportedLocales supportedLocales
     */
    public function setSupportedLocales(array $supportedLocales)
    {
        $this->supportedLocales = $supportedLocales;
    }

    /**
     * @param string $locale locale
     *
     * @return boolean
     */
    public function suggestLocale($locale)
    {
        return in_array($locale, $this->supportedLocales);
    }
}
