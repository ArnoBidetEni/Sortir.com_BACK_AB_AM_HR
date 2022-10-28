<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\City;

class CityFixtures extends Fixture
{
    public const CITY_CHOLLET = "chollet";
    public const CITY_NANTES = "nantes";
    public const CITY_BOUGUENAIS = "bouguenais";

    public function load(ObjectManager $manager): void
    {
        $this->createCholet($manager);
        $this->createNantes($manager);
        $this->createBouguenais($manager);
    }

    private function createCholet(ObjectManager $manager)
    {
        $city = new City();
        $city->setName("Cholet");
        $city->setPostCode("49300");

        $manager->persist($city);
        $manager->flush();

        $this->addReference(self::CITY_CHOLLET, $city);
    }

    private function createNantes(ObjectManager $manager)
    {
        $city = new City();
        $city->setName("Nantes");
        $city->setPostCode("44300");

        $manager->persist($city);
        $manager->flush();

        $this->addReference(self::CITY_NANTES, $city);
    }

    private function createBouguenais(ObjectManager $manager)
    {
        $city = new City();
        $city->setName("Bouguenais");
        $city->setPostCode("44340");

        $manager->persist($city);
        $manager->flush();

        $this->addReference(self::CITY_BOUGUENAIS, $city);
    }
}