<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Participant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Asset\Package;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use League\Csv\Reader;
use League\Csv\Statement;


class RegisterController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }
    
    #[Route('/csv', name: 'csv_import', methods: ['POST'])]
    public function exec()
    {

        // verifier que c'est un csv 
         // %% name 3 derniers caractères extension type   
        $reader = Reader::createFromPath('C:\Users\hrouff2021\Sortir.com_AB_AM_HR_Back\Sortir.com_BACK_AB_AM_HR\Classeur.csv');
        $reader->setHeaderOffset(0);
        $records = Statement::create()->process($reader);

 
        $i = 0;  
        $message = "\n Erreurs d'insertion trouvées : ";

        foreach ($records->getRecords() as $record) {
    
              $arrayValue = array();
              $arrayValue   = implode (';', $record);
              $value0 = (explode(';', $arrayValue))[0];
              $value1 = (explode(';', $arrayValue))[1];
              $value2 = (explode(';', $arrayValue))[2];
              $value3 = (explode(';', $arrayValue))[3];
              $value4 = (explode(';', $arrayValue))[4];
              $value5 = (explode(';', $arrayValue))[5];
              
              if($value0 == null || $value0 == "" ||
              $value1 == null || $value1 == "" ||
              $value2 == null || $value2 == "" ||
              $value3 == null || $value3 == "" ||
              $value4 == null || $value4 == "" ||
              $value5 == null || $value5 == "")
              {
                $message .= " \n Ligne n°" . $i ." incorrecte, insertion des données de la ligne annulée." ;
              }
              else
              {

            $campus = new Campus();
            $campus = $this->em->getRepository(Campus::class)
            ->findOneBy([
                'name' => $value5]);   
            
                if ($campus == null)
                {
                    $campus = new Campus();
                   $campus->setName($value5);
                   $this->em->persist($campus);
                }

            $participant = new Participant();
            $participant = $this->em->getRepository(Participant::class)
            ->findOneBy([
                'login' => $value2]);   
            
                if ($participant == null)
                {
                $participant = (new Participant())
                ->setName( $value0 )
                ->setFirstName( $value1 )
                ->setLogin( $value2 )
                ->setAdministrator(false)
                ->setActive(true)
                ->setPhoneNumber($value3)
                ->setCampus($campus)
                ->setMail($value4)
                ->setPassword($this->generateRandomString(8));
                } 

            $this->em->persist($participant);
            $this->em->flush();  
            }
        }

      

    }



    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ%!:;,^$*';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}


?>