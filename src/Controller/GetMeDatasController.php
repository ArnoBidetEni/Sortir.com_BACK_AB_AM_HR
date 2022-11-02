<?php

namespace App\Controller;

use App\Entity\Participant;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class GetMeDatasController extends AbstractController
{
    public function __construct(
        private ManagerRegistry $doctrine
    ){}

    public function __invoke(Request $request): JsonResponse
    {
        $requestAuthorizationToken = $request->server->getHeaders()['AUTHORIZATION'];

        $accessToken = trim($requestAuthorizationToken, 'Bearer ');

        $tokenParts = explode(".", $accessToken);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload);

        $username = $jwtPayload->username;

        $participant = $this->doctrine->getRepository(Participant::class)
        ->getMe($username);

        return $this->json($participant);
    }
}
