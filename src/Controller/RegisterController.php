<?php

namespace App\Controller;

use App\Entity\Participant;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine): JsonResponse
    {
        $login = $request->get('login');
        $password = $request->get('password');

        $user = new Participant();
        $user->setName("Doe");
        $user->setFirstName("John");
        $user->setLogin($login);
        $user->setAdministrator(false);
        $user->setActive(true);
        $user->setPhoneNumber('0102030405');
        $user->setMail($login . "@campus-eni.fr");

        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $password
        );

        $user->setPassword($hashedPassword);

        $em = $doctrine->getManager();
        $em->persist($user);
        $em->flush();

        return new JsonResponse("Access Granted");
    }
}
