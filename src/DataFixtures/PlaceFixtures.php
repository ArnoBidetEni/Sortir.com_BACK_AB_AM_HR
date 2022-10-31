<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Place;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PlaceFixtures extends Fixture implements DependentFixtureInterface
{
    public const PLACE_PLACE_TRAVOT = "place_travot";
    public const PLACE_ENI = "eni";
    public const PLACE_CARREFOUR_SAINT_HERBLAIN = "carrefour_saint_herblain";

    public function load(ObjectManager $manager): void
    {
        $this->createPlaceTravot($manager);
        $this->createEni($manager);
        $this->createCarrefourSaintHerblain($manager);
    }

    private function createPlaceTravot(ObjectManager $manager)
    {
        $place = new Place();
        $place->setName("Place Travot");
        $place->setStreet("Rue national");
        $place->setCity($this->getReference(CityFixtures::CITY_CHOLLET));
        $place->setLatitude(47.061817151582396);
        $place->setLongitude(-0.8804509535134951);

        $manager->persist($place);
        $manager->flush();

        $this->addReference(self::PLACE_PLACE_TRAVOT, $place);
    }

    private function createEni(ObjectManager $manager)
    {
        $place = new Place();
        $place->setName("Eni");
        $place->setStreet("2a Rue Benjamin Franklin");
        $place->setCity($this->getReference(CityFixtures::CITY_CHOLLET));
        $place->setLatitude(47.22630836729093);
        $place->setLongitude(-1.6203953215439333);

        $manager->persist($place);
        $manager->flush();

        $this->addReference(self::PLACE_ENI, $place);
    }

    private function createCarrefourSaintHerblain(ObjectManager $manager)
    {
        $place = new Place();
        $place->setName("Carrefour Saint Herblain");
        $place->setStreet("Avenue de la soif");
        $place->setCity($this->getReference(CityFixtures::CITY_CHOLLET));
        $place->setLatitude(47.2226007687568);
        $place->setLongitude(-1.6050238739218265);

        $manager->persist($place);
        $manager->flush();

        $this->addReference(self::PLACE_CARREFOUR_SAINT_HERBLAIN, $place);
    }

    public function getDependencies()
    {
        return [
            CityFixtures::class
        ];
    }
}