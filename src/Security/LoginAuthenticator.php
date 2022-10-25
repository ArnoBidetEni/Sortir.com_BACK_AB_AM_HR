<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class LoginAuthenticator extends AbstractAuthenticator
{
    public function supports(Request $request): ?bool
    {
        // TODO: Implement supports() method.
    }

    public function authenticate(Request $request): Passport
    {
        // TODO: Implement authenticate() method.
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $response = parent::onAuthenticationSuccess($request, $token, "main");

        $tokenJWT = json_decode($response->getContent(), true)['token'];

        // Ajoute le token avec l'id de l'utilisateur en clé dans les Redis configurés, avec le ttl contenu dans la conf
        $this->rms->set($this->redisDB, $token->getUser()->getId(), $tokenJWT, $this->jwtTokenTTL);

        // Crée le cookie contenant le token, avec le ttl contenu dans la conf
        $response->headers->setCookie(new Cookie('CERBERE', $tokenJWT, (new \DateTime())->add(new \DateInterval('PT' . $this->jwtTokenTTL . 'S')), '/', null, $this->cookieSecure));

        return $response;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        // TODO: Implement onAuthenticationFailure() method.
    }

//    public function start(Request $request, AuthenticationException $authException = null): Response
//    {
//        /*
//         * If you would like this class to control what happens when an anonymous user accesses a
//         * protected page (e.g. redirect to /login), uncomment this method and make this class
//         * implement Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface.
//         *
//         * For more details, see https://symfony.com/doc/current/security/experimental_authenticators.html#configuring-the-authentication-entry-point
//         */
//    }
}
