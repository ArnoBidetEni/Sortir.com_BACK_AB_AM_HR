<?php

namespace App\DataFixtures;

use App\Entity\Excursion;
use App\Entity\Participant;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ExcursionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $this->createPhilo($manager);
        $this->createOrigami($manager);
        $this->createPerles($manager);
        $this->createConcertMetal($manager);
        $this->createJardinage($manager);
        $this->createCinéma($manager);
        $this->createPateASel($manager);
        $this->createProgrammation($manager);
    }

    private function createPhilo(ObjectManager $manager)
    {
        $excursion = new Excursion();
        $excursion->setName("Philo");
        $excursion->setStartTime(new DateTime("2018-07-19T23:45:00"));
        $excursion->setDuration(60);
        $excursion->setLimitDateRegistration(new DateTime("2018-07-10"));
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

    private function createOrigami(ObjectManager $manager)
    {
        $excursion = new Excursion();
        $excursion->setName("Origami");
        $excursion->setStartTime(new DateTime("2022-11-21T20:00:00"));
        $excursion->setDuration(45);
        $excursion->setLimitDateRegistration(new DateTime("2022-11-15"));
        $excursion->setMaxRegistrationNumber(5);
        $excursion->setExcursionData("Aujourd'hui, pliage de feuille avec les enfants du canton");
        $excursion->setExcursionPlace($this->getReference(PlaceFixtures::PLACE_PLACE_TRAVOT));
        $excursion->setStatus($this->getReference(StatusFixtures::STATUS_OPENED));
        $excursion->setOrganisator($this->getReference(ParticipantFixtures::USER_1));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_3));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_5));
        $excursion->setCampus($this->getReference(CampusFixtures::CAMPUS_SAINT_HERBLAIN));

        $manager->persist($excursion);
        $manager->flush();
    }

    private function createPerles(ObjectManager $manager)
    {
        $excursion = new Excursion();
        $excursion->setName("Perles");
        $excursion->setStartTime(new DateTime("2022-11-15T20:00:00"));
        $excursion->setDuration(60);
        $excursion->setLimitDateRegistration(new DateTime("2022-10-31"));
        $excursion->setMaxRegistrationNumber(12);
        $excursion->setExcursionData("On enfile des perles, avant d'enfiler ta m***");
        $excursion->setExcursionPlace($this->getReference(PlaceFixtures::PLACE_PLACE_TRAVOT));
        $excursion->setStatus($this->getReference(StatusFixtures::STATUS_CLOSED));
        $excursion->setOrganisator($this->getReference(ParticipantFixtures::USER_3));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_4));
        $excursion->setCampus($this->getReference(CampusFixtures::CAMPUS_RENNES));

        $manager->persist($excursion);
        $manager->flush();
    }

    private function createConcertMetal(ObjectManager $manager)
    {
        $excursion = new Excursion();
        $excursion->setName("Concert metal");
        $excursion->setStartTime(new DateTime("2022-09-21T20:30:00"));
        $excursion->setDuration(90);
        $excursion->setLimitDateRegistration(new DateTime("2022-09-12"));
        $excursion->setMaxRegistrationNumber(8);
        $excursion->setExcursionData("Sortie au Hellfest");
        $excursion->setExcursionPlace($this->getReference(PlaceFixtures::PLACE_PLACE_TRAVOT));
        $excursion->setStatus($this->getReference(StatusFixtures::STATUS_PAST));
        $excursion->setOrganisator($this->getReference(ParticipantFixtures::USER_2));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_5));
        $excursion->setCampus($this->getReference(CampusFixtures::CAMPUS_RENNES));

        $manager->persist($excursion);
        $manager->flush();
    }

    private function createJardinage(ObjectManager $manager)
    {
        $excursion = new Excursion();
        $excursion->setName("Jardinage");
        $excursion->setStartTime(new DateTime("2022-12-01T20:30:00"));
        $excursion->setDuration(90);
        $excursion->setLimitDateRegistration(new DateTime("2022-10-15"));
        $excursion->setMaxRegistrationNumber(8);
        $excursion->setExcursionData("On plante des carottes");
        $excursion->setExcursionPlace($this->getReference(PlaceFixtures::PLACE_PLACE_TRAVOT));
        $excursion->setStatus($this->getReference(StatusFixtures::STATUS_CLOSED));
        $excursion->setOrganisator($this->getReference(ParticipantFixtures::USER_2));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_2));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_3));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_5));
        $excursion->setCampus($this->getReference(CampusFixtures::CAMPUS_RENNES));

        $manager->persist($excursion);
        $manager->flush();
    }

    private function createCinéma(ObjectManager $manager)
    {
        $excursion = new Excursion();
        $excursion->setName("Cinéma");
        $excursion->setStartTime(new DateTime("2022-12-20T18:30:00"));
        $excursion->setDuration(45);
        $excursion->setLimitDateRegistration(new DateTime("2022-12-01"));
        $excursion->setMaxRegistrationNumber(5);
        $excursion->setExcursionData("On va voir matrix. Pilule bleue ou pilule rouge ?");
        $excursion->setExcursionPlace($this->getReference(PlaceFixtures::PLACE_PLACE_TRAVOT));
        $excursion->setStatus($this->getReference(StatusFixtures::STATUS_OPENED));
        $excursion->setOrganisator($this->getReference(ParticipantFixtures::USER_2));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_2));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_3));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_5));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_1));
        $excursion->setCampus($this->getReference(CampusFixtures::CAMPUS_RENNES));

        $manager->persist($excursion);
        $manager->flush();
    }

    private function createPateASel(ObjectManager $manager)
    {
        $excursion = new Excursion();
        $excursion->setName("Pâte à sel");
        $excursion->setStartTime(new DateTime("2022-11-15T21:00:00"));
        $excursion->setDuration(90);
        $excursion->setLimitDateRegistration(new DateTime("2022-11-12"));
        $excursion->setMaxRegistrationNumber(10);
        $excursion->setExcursionData("Saucisses, doigts, carottes, aubergines, concombre... le tout en pâte à sel !");
        $excursion->setExcursionPlace($this->getReference(PlaceFixtures::PLACE_PLACE_TRAVOT));
        $excursion->setStatus($this->getReference(StatusFixtures::STATUS_OPENED));
        $excursion->setOrganisator($this->getReference(ParticipantFixtures::USER_5));
        $excursion->setCampus($this->getReference(CampusFixtures::CAMPUS_RENNES));

        $manager->persist($excursion);
        $manager->flush();
    }

    private function createProgrammation(ObjectManager $manager)
    {
        $excursion = new Excursion();
        $excursion->setName("Programmation");
        $excursion->setStartTime(new DateTime("2022-12-03T19:30:00"));
        $excursion->setDuration(90);
        $excursion->setLimitDateRegistration(new DateTime("2022-11-01"));
        $excursion->setMaxRegistrationNumber(5);
        $excursion->setExcursionData("Aujour'hui on apprend WordPr... Non mais rester je promet ça va être bien !");
        $excursion->setExcursionPlace($this->getReference(PlaceFixtures::PLACE_PLACE_TRAVOT));
        $excursion->setStatus($this->getReference(StatusFixtures::STATUS_CLOSED));
        $excursion->setOrganisator($this->getReference(ParticipantFixtures::USER_5));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_2));
        $excursion->addParticipant($this->getReference(ParticipantFixtures::USER_5));
        $excursion->setCampus($this->getReference(CampusFixtures::CAMPUS_RENNES));

        $manager->persist($excursion);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CampusFixtures::class,
            PlaceFixtures::class,
            StatusFixtures::class,
            ParticipantFixtures::class
        ];
    }
}