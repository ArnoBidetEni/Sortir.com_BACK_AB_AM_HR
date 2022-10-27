<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Routing\Annotation\Route;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Participant;

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
    public function getUserDatas(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        $requestAuthorizationToken = $request->server->getHeaders()['AUTHORIZATION'];

        $accessToken = trim($requestAuthorizationToken, 'Bearer ');

        $tokenParts = explode(".", $accessToken);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        // $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);

        $username = $jwtPayload->username;

        $participant = $doctrine->getRepository(Participant::class)
            ->findOneBy(['login'=> $username]);

        $participant->setPassword("");

        return new JsonResponse($participant);
    }
}
