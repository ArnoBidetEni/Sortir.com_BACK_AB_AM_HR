<?php

namespace App\Controller;

use App\Entity\Excursion;
use App\Entity\Participant;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[AsController]
class WithdrawFromAnExcursion extends AbstractController
{
    public function __construct(
        private ManagerRegistry $doctrine
    ){}

    public function __invoke(int $excursionId, int $participantId): void
    {
        $excursion = $this->checkIfExcursionExist($excursionId);

        if ($excursion->getStatus()->getStatusId() === 1)
        {
            $participant = $this->checkIfParticipantExist($participantId);

            $participantIsInTheExcursion = false;

            foreach ($excursion->getParticipants() as $excursionParticipant)
            {
                if ($excursionParticipant === $participant)
                {
                    $participantIsInTheExcursion = true;
                    break;
                }
            }

            if (!$participantIsInTheExcursion)
            {
                throw new Exception("Le participant ne fait pas parti de l'activité");
            }

            $excursion->remove($participant);

            $em = $this->doctrine->getManager();
            $em->persist($excursion);
            $em->flush();

        }else {

            throw new Exception("L'activité n'a pas le statut ouvert");
        }
    }

    private function checkIfExcursionExist(int $excursionId)
    {
        $excursion = $this->doctrine->getRepository(Excursion::class)->findOneBy(['excursionId' => $excursionId]);

        if ($excursion)
        {
            return $excursion;

        } else {

            throw new NotFoundHttpException("Aucune activité trouvée pour cet identifiant");
        }
    }
    
    private function checkIfParticipantExist(int $participantId)
    {
        $participant = $this->doctrine->getRepository(Participant::class)->findOneBy(['participantId' => $participantId]);

        if ($participant)
        {
            return $participant;

        } else {

            throw new NotFoundHttpException("Aucun participant trouvée pour cet identifiant");
        }
    }
}
