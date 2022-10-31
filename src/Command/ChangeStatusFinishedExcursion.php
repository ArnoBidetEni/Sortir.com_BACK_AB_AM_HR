<?php

namespace App\Command;

use App\Repository\ExcursionRepository;
use DateInterval;
use DateTime;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:changeStatusFinishedExcursion')]
class ChangeStatusFinishedExcursion extends Command
{
    public function __construct(
        private ExcursionRepository $excursionRepository
    ){
        parent::__construct();
    }

    protected function configure () {
        // On set le nom de la commande
        $this->setName('app:changeStatusFinishedExcursion');

        // On set la description
        $this->setDescription("Permet de changer le statut des excursions qui sont finies");

        // On set l'aide
        $this->setHelp("Je serai affiche si on lance la commande bin/console app:create-user -h");
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $datas = $this->excursionRepository->editStatusFinishedExcursions();

        if ($datas) {
            
            for ($i=0; $i < sizeof($datas); $i++) { 

                if ($datas[$i]['statusId'] === 2)
                {
                    $actualDate = new DateTime();

                    $endOfTheExcursion = $datas[$i]['startTime']->add(new DateInterval('PT' . $datas[$i]['duration'] . 'M'));

                    if ($endOfTheExcursion > $actualDate)
                    {
                        dd("L'excursion vient de commencé");
                        $datas[$i]->setStatus(4);
                    }
                    
                    
                } else {
                    dd($datas[$i]);
                }
                
            }
        }
        else {
            dd("Pas de données");
        }

        // dd($datas);

        // ... put here the code to create the user

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
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