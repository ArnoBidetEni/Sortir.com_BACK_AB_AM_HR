<?php

namespace App\Security;

use Lexik\Bundle\JWTAuthenticationBundle\Security\Authenticator\JWTAuthenticator;
use Symfony\Config\LexikJwtAuthentication\TokenExtractorsConfig;

class CustomAuthenticator extends JWTAuthenticator
{
    /**
    * @return TokenExtractor\TokenExtractorInterface
    */
    // protected function getTokenExtractor()
    // {
    //     // Or retrieve the chain token extractor for mapping/unmapping extractors for this authenticator
    //     $chainExtractor = parent::getTokenExtractor();

    //     // Clear the token extractor map from all configured extractors
    //     // $chainExtractor->clearMap();

    //     // Or only remove a specific extractor
    //     $chainTokenExtractor->removeExtractor(function (TokenExtractor\TokenExtractorInterface $extractor) {
    //         return $extractor instanceof TokenExtractor\CookieTokenExtractor;
    //     });

    //     // Add a new query parameter extractor to the configured ones
    //     $chainExtractor->addExtractor(new TokenExtractor\QueryParameterTokenExtractor('jwt'));

    //     // Return the chain token extractor with the new map
    //     return $chainTokenExtractor;
    // }
}