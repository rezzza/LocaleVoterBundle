<?php

namespace Rezzza\LocaleVoterBundle\Locale\Voter;

use Rezzza\LocaleVoterBundle\Locale\Context\LocaleContextInterface;

/**
 * AcceptLanguageVoter
 *
 * @uses AbstractVoter
 * @uses VoterInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class AcceptLanguageVoter extends AbstractVoter implements VoterInterface
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

        return $request->getPreferredLanguage($this->supportedLocales);
    }
}
