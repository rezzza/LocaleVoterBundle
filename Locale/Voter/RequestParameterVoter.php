<?php

namespace Rezzza\LocaleVoterBundle\Locale\Voter;

use Rezzza\LocaleVoterBundle\Locale\Context\LocaleContextInterface;

/**
 * RequestParameterVoter
 *
 * @uses AbstractVoter
 * @uses VoterInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class RequestParameterVoter extends AbstractVoter implements VoterInterface
{
    /**
     * {@inheritdoc}
     */
    public function vote(LocaleContextInterface $context)
    {
        $request = $context->getRequest();

        if (!$request) {
            throw new \Exception(sprintf('Voter "%s" needs Request on context', __CLASS__));
        }

        $locale = $request->get('_locale');
        if ($locale && $this->suggestLocale($locale)) {
            return $locale;
        }
    }
}
