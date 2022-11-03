<?php
namespace App\Listener;

use App\Security\LoginAuthenticator;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\HttpFoundation\Cookie;
// #[AsEventListener(
//     event: 'lexik_jwt_authentication.on_authentication_success',
//     method: 'onAuthenticationSuccessResponse',
//     priority: 10)]
class AuthenticationSuccessListener
{
    public function __construct(
        private LoginAuthenticator $loginAuthenticator
    ){}

    public function onAuthenticationSuccessResponse(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $tokenJWT = $request->getData()['token'];
        
        $response = $request->getResponse();
        
        $userId = $request->getUser()->getParticipantId();

        // $this->loginAuthenticator->onAuthenticationSuccess($response, $tokenJWT, 'main');

        // Ajoute le token avec l'id de l'utilisateur en clé dans les Redis configurés, avec le ttl contenu dans la conf
        // $this->rms->set($this->redisDB, $userId, $tokenJWT, $this->jwtTokenTTL);

        // Crée le cookie contenant le token, avec le ttl contenu dans la conf
        $response->headers->setCookie(new Cookie('access_token', $tokenJWT, (new \DateTime())->add(new \DateInterval('PT' . $this->jwtTokenTTL . 'S')), '/', null, $this->cookieSecure));

        return $response;

    //     $data = $event->getData();
    //     $user = $event->getUser();
    //     if (!$user instanceof UserInterface) {
    //         // return;
    //     }
    //     $data['data'] = array(
    //         'username' => 'bob',
    //     );
    //     $event->setData($data);
    }
}