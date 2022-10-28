<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Campus;

class CampusFixtures extends Fixture
{
    public const CAMPUS_SAINT_HERBLAIN = 'saint_herblain';
    public const CAMPUS_RENNES = 'rennes';
    public const CAMPUS_NIORT = 'niort';
    public const CAMPUS_CHARTRES_DE_BRETAGNE = 'chartres_de_bretagne';
    public const CAMPUS_LA_ROCHE_SUR_YON = 'la_roche_sur_yon';

    public function load(ObjectManager $manager): void
    {
        $this->createSaintHerblain($manager);
        $this->createRennes($manager);
        $this->createNiort($manager);
        $this->createChartresDeBretagne($manager);
        $this->createLaRocheSurYon($manager);
    }

    private function createSaintHerblain(ObjectManager $manager)
    {
        $campus = new Campus();
        $campus->setName("Saint-Herblain");

        $manager->persist($campus);
        $manager->flush();

        $this->addReference(self::CAMPUS_SAINT_HERBLAIN, $campus);
    }

    private function createRennes(ObjectManager $manager)
    {
        $campus = new Campus();
        $campus->setName("Rennes");

        $manager->persist($campus);
        $manager->flush();

        $this->addReference(self::CAMPUS_RENNES, $campus);
    }

    private function createNiort(ObjectManager $manager)
    {
        $campus = new Campus();
        $campus->setName("Niort");

        $manager->persist($campus);
        $manager->flush();

        $this->addReference(self::CAMPUS_NIORT, $campus);
    }

    private function createChartresDeBretagne(ObjectManager $manager)
    {
        $campus = new Campus();
        $campus->setName("Chartres de Bretagne");

        $manager->persist($campus);
        $manager->flush();

        $this->addReference(self::CAMPUS_CHARTRES_DE_BRETAGNE, $campus);
    }

    private function createLaRocheSurYon(ObjectManager $manager)
    {
        $campus = new Campus();
        $campus->setName("La Roche sur Yon");

        $manager->persist($campus);
        $manager->flush();

        $this->addReference(self::CAMPUS_LA_ROCHE_SUR_YON, $campus);
    }
}
