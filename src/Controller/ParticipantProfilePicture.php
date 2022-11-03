<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Service\FileUploader;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ParticipantProfilePicture extends AbstractController
{
    public function __construct(
        private ManagerRegistry $doctrine
    ){}

    #[Route('/api/participants/{participantId}/setPicture', name: 'api_edit_participant_set_picture')]
    public function setParticipantProfilePicture(Request $request, FileUploader $fileUploader): Response
    {
        $requestAuthorizationToken = $request->server->getHeaders()['AUTHORIZATION'];

        $accessToken = trim($requestAuthorizationToken, 'Bearer ');

        $tokenParts = explode(".", $accessToken);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload);

        $username = $jwtPayload->username;

        $participant = $this->doctrine->getRepository(Participant::class)->findOneBy(['login' => $username]);

        if ($participant)
        {
            if($participant->getPicture())
            {
                // print($participant->getPicture());
                // unlink('%kernel.project_dir%/public/uploads/profilePictures/'.$participant->getPicture());
                $fileSystem = new Filesystem();
                $fileSystem->remove('/uploads/profilePictures/'.$participant->getPicture());
            }

            $requestProfilePicture = $request->files->get('file');

            $profilePictureName = $fileUploader->upload($requestProfilePicture, $participant->getParticipantId());
            $participant->setPicture($profilePictureName);

            $em = $this->doctrine->getManager();
            $em->persist($participant);
            $em->flush();

            return $this->json(['pictureName' => $profilePictureName]);
            
        } else {

            throw new  NotFoundResourceException("No participant was found for this identifier, retry again");
        }
    }
}
