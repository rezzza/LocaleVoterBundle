<?php

namespace Rezzza\LocaleVoterBundle\Locale\Context;

use Symfony\Component\HttpFoundation\Request;

/**
 * LocaleContextInterface
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
interface LocaleContextInterface
{
    public function setRequest(Request $request);
    public function getRequest();

    public function setParameter($key, $value);
    public function hasParameter($key);
    public function getParameter($key, $default = null);
}
