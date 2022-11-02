<?php

namespace App\Controller;

use App\Entity\Participant;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

#[AsController]
class DisableAUserController extends AbstractController
{
    public function __construct(
        private ManagerRegistry $doctrine
    ){}

    public function __invoke(int $participantId): void
    {
        $participant = $this->doctrine->getRepository(Participant::class)->findOneBy(['participantId' => $participantId]);

        if ($participant)
        {
            if ($participant->isActive())
            {
                dd("Je suis actif");
            }
            else {
                dd("Je ne suis pas actif");
            }
        }
        else {
            
            throw new NotFoundResourceException("Participant non trouvée", 500);
        }
    }
}
