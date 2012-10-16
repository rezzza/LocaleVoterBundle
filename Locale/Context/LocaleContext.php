<?php

namespace Rezzza\LocaleVoterBundle\Locale\Context;

use Symfony\Component\HttpFoundation\Request;

/**
 * LocaleContext
 *
 * @uses LocaleContextInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class LocaleContext implements LocaleContextInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var array
     */
    private $parameters = array();

    /**
     * {@inheritdoc}
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($key, $default = null)
    {
        return $this->hasParameter($key) ? $this->parameters[$key] : $default;
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter($key)
    {
        return isset($this->parameters[$key]);
    }
}
