<?php

namespace App\Command;

use App\Entity\Excursion;
use App\Repository\ExcursionRepository;
use DateInterval;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:changeStatusExcursion')]
class ChangeStatusFinishedExcursion extends Command
{
    public function __construct(
        private ExcursionRepository $excursionRepository,
        private ManagerRegistry $doctrine
    ){
        parent::__construct();
    }

    protected function configure () {
        // On set le nom de la commande
        $this->setName('app:changeStatusExcursion');

        // On set la description
        $this->setDescription("Permet de changer le statut des excursions en fonction des dates");

        // On set l'aide
        $this->setHelp("Je serai affiche si on lance la commande bin/console app:create-user -h");
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $datas = $this->excursionRepository->editStatusFinishedExcursions();

        if ($datas) {
            
            for ($i=0; $i < sizeof($datas); $i++)
            {
                $excursion = $this->doctrine->getRepository(Excursion::class)->findOneBy(['excursionId' => $datas[$i]['excursionId']]);

                $actualDate = new DateTime();

                if ($datas[$i]['statusId'] === 2)
                {
                    if ($datas[$i]['startTime'] > $actualDate)
                    {
                        dd("L'excursion vient de commencé");
                        $excursion->setStatus(4);
                    }
                }
                else if ($datas[$i]['statusId'] === 4)
                {
                    $endOfTheExcursion = $datas[$i]['startTime']->add(new DateInterval('PT' . $datas[$i]['duration'] . 'M'));

                    if ($endOfTheExcursion > $actualDate)
                    {
                        $excursion->setStatus(5);
                    }
                }
                else {
                    # code...
                }

                $em = $this->doctrine->getManager();
                $em->persist($excursion);
            }

            $em->flush();
        }

        $output->writeln("La commande c'est bien passée!");
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}