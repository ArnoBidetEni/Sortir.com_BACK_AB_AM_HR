<?php

namespace App\Controller;

use App\Entity\Participant;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

#[AsController]
class EditParticipant extends AbstractController
{
    public function __construct(
        private ManagerRegistry $doctrine,
        private UserPasswordHasherInterface $passwordHasher
    ){}

    // #[Route('/api/participants/{participantId}', name: 'api_edit_participant')]
    // public function editParticipant(Request $request, int $participantId): JsonResponse
    // {
    //     $participant = $this->doctrine->getRepository(Participant::class)->findOneBy(['participantId' => $participantId]);

    //     if ($participant)
    //     {
    //         $requestDatas = json_decode($request->getContent());

    //         $participant->setLastName($requestDatas->lastName);
    //         $participant->setFirstName($requestDatas->firstName);
    //         $participant->setLogin($requestDatas->login);
    //         $participant->setPhoneNumber($requestDatas->phoneNumber);
    //         $participant->setMail($requestDatas->mail);

    //         if ($requestDatas->password) {
    //             $hashedPassword = $this->passwordHasher->hashPassword(
    //                 $participant,
    //                 $requestDatas->password
    //             );

    //             $participant->setPassword($hashedPassword);
    //         }

    //         $em = $this->doctrine->getManager();
    //         $em->persist($participant);
    //         $em->flush();

    //     } else {

    //         throw new NotFoundResourceException("No Participant found for this identifier");
    //     }

    //     return new JsonResponse("Participant well edited");
    // }

    public function __invoke(Participant $participant, Request $request): JsonResponse
    {
        if ($participant)
        {
            $requestDatas = json_decode($request->getContent());

            $participant->setLastName($requestDatas->lastName);
            $participant->setFirstName($requestDatas->firstName);
            $participant->setLogin($requestDatas->login);
            $participant->setPhoneNumber($requestDatas->phoneNumber);
            $participant->setMail($requestDatas->mail);

            if ($requestDatas->password) {
                $hashedPassword = $this->passwordHasher->hashPassword(
                    $participant,
                    $requestDatas->password
                );

                $participant->setPassword($hashedPassword);
            }

            $em = $this->doctrine->getManager();
            $em->persist($participant);
            $em->flush();

        } else {

            throw new NotFoundResourceException("No Participant found for this identifier");
        }

        return new JsonResponse("Participant well edited");
    }
}

