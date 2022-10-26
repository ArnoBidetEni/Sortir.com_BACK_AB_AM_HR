<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SecurityController extends AbstractController
{
    public function __construct(TokenStorageInterface $tokenStorageInterface, JWTTokenManagerInterface $jwtManager)
    {
        $this->jwtManager = $jwtManager;
        $this->tokenStorageInterface = $tokenStorageInterface;
    }

    #[Route('/api/logout', name: 'api_logout', methods: ['GET'])]
    public function logout()
    {
        $response = new Response();
        $response->headers->clearCookie('access_token', '/', null);
    }

    #[Route('/api/me', name: 'api_me', methods: ['GET'])]
    public function getUserDatas(Request $request)
    {
        // $decodedJwtToken = $this->jwtManager->decode($this->tokenStorageInterface->getToken());

        $cookie = $request->cookie->get('access_token');
        dd($cookie);
        // $token = ;
        // $tokenParts = explode(".", $token);  
        // $tokenHeader = base64_decode($tokenParts[0]);
        // $tokenPayload = base64_decode($tokenParts[1]);
        // $jwtHeader = json_decode($tokenHeader);
        // $jwtPayload = json_decode($tokenPayload);
        // print $jwtPayload->username;
    }
}
