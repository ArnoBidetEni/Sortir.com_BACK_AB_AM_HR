<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

class CampusFixtures extends Fixture
{
    public const CAMPUS_SAINT_HERBLAIN = 'saint_herblain';

    public function __construct(
        private ObjectManager $manager
    ){}

    public function load(): void
    {
        $this->createSaintHerblain();
    }

    private function createSaintHerblain()
    {
        $campus = new Campus();
        $campus->setName("Saint-Herblain");

        $this->manager->persist($campus);
        $this->manager->flush();

        $this->addReference(self::CAMPUS_SAINT_HERBLAIN, $campus);
    }
}
