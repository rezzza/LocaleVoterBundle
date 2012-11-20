LocaleVoterBundle
=================

DEPRECATED
==========

Use [LocaleBundle](https://github.com/lunetics/LocaleBundle) instead.
=====================================================================

Fetch locale of project through voters.

# Installation

Using composer:

```json
    "rezzza/locale-voter-bundle": "1.0.*",
```

Then

```
composer update "rezzza/locale-voter-bundle"
```

Add on you AppKernel:

```
    $bundles = array(
        ...
        new Rezzza\LocaleVoterBundle\RezzzaLocaleVoterBundle(),
        ...
    )
```

Define configuration on your config.yml:

```yaml
rezzza_locale_voter:
    strategy: request        # only one strategy available, you can set null to manually decide of locale.
    default_locale: %locale% # set fallback locale.
    locales: ['en', 'fr']    # Define valid locales.
    voters:                  # A list of voter. Order define priority.
        - rezzza.locale_voter.request_parameter.voter
        - rezzza.locale_voter.accept_language.voter
```

# Usage

With default configuration defined above, it'll look at `_locale` GET parameter in first time, if it does not match, it will look at accept language headers.
`locale` voted (defined on voters on default) will be setted on request.

You can easily define new voters or define your own strategy.

# Write a Voter

You have just to inherit from `VoterInterface` and add the service id of the voter on the configuration.

Example of voter:

```php
<?php

namespace Acme\DoudaBundle\Locale\Voter;

use Rezzza\LocaleVoterBundle\Locale\Context\LocaleContextInterface;
use Rezzza\LocaleVoterBundle\Locale\Voter\AbstractVoter;

class MyVoter extends AbstractVoter implements VoterInterface
{
    /**
     * {@inheritdoc}
     */
    public function vote(LocaleContextInterface $context)
    {
        $request = $context->getRequest();

        // suggestLocale will check if locale is supported.
        if ($request->get('chuck') === 'testa' && $this->suggestLocale('NOPE')) {
            return 'NOPE';
        }
    }

}
```

# Todo

- Write tests.
