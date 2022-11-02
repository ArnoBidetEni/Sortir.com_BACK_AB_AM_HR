<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Routing\Annotation\Route;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
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
}
