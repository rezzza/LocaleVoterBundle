<?php

namespace Rezzza\LocaleVoterBundle\Locale\Strategy;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Rezzza\LocaleVoterBundle\Locale\LocaleDecisionManager;
use Rezzza\LocaleVoterBundle\Locale\Context\LocaleContext;

/**
 * RequestStrategy
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class RequestStrategy
{
    /**
     * @var LocaleDecisionManager
     */
    private $localeDecisionManager;

    /**
     * @param LocaleDecisionManager $localeDecisionManager localeDecisionManager
     */
    public function __construct(LocaleDecisionManager $localeDecisionManager)
    {
        $this->localeDecisionManager = $localeDecisionManager;
    }

    /**
     * @param GetResponseEvent $event event
     */
    public function onRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $context = new LocaleContext();
        $context->setRequest($request);

        $locale  = $this->localeDecisionManager->decide($context);
        $request->setLocale($locale);
    }
}
