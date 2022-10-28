<?php

namespace App\DataFixtures;

use App\Entity\Excursion;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExcursionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->createPhilo($manager);
    }

    private function createPhilo(ObjectManager $manager)
    {
        $excursion = new Excursion();
        $excursion->setName("Philo");
        $excursion->setStartTime(new DateTime("2018-07-19T23:45:00"));
        $excursion->setDuration(60);
        $excursion->setLimiteDateRegistration(new DateTime("2018-07-10"));
        $excursion->setMaxRegistrationNumber(8);
        $excursion->setExcursionData("On va parler de Kant ouech ouech");
        $excursion->setExcursionPlace($this->getReference(PlaceFixtures::PLACE_PLACE_TRAVOT));
        $excursion->setStatus($this->getReference(StatusFixtures::STATUS_PAST));
        $excursion->setOrganisator($this->getReference(ParticipantFixtures::USER_1));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_2));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_4));
        $excursion->setCampus($this->getReference(CampusFixtures::CAMPUS_SAINT_HERBLAIN));

        $manager->persist($excursion);
        $manager->flush();
    }
}
