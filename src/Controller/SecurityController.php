<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/api/logout', name: 'api_logout', methods: ['GET'])]
    public function logout()
    {
        $response = new Response();
        $response->headers->clearCookie('access_token', '/', null);
    }
}
