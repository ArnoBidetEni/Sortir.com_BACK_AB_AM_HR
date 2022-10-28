<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Status;

class StatusFixtures extends Fixture
{
    public const STATUS_CREATE = "créée";
    public const STATUS_OPENED = "ouverte";
    public const STATUS_CLOSED = "clôturée";
    public const STATUS_CURRENT = "activitée en cours";
    public const STATUS_PAST = "passée";
    public const STATUS_CANCELLED = "annulée";
    public const STATUS_CREATION_IN_PROGRESS = "création en cours";

    public function load(ObjectManager $manager): void
    {
        $this->createCreate($manager);
        $this->createOpened($manager);
        $this->createClosed($manager);
        $this->createCurrent($manager);
        $this->createPast($manager);
        $this->createCancelled($manager);
        $this->createCreationInProgress($manager);
    }

    private function createCreate(ObjectManager $manager)
    {
        $status = new Status();
        $status->setName("Créée");

        $manager->persist($status);
        $manager->flush();

        $this->addReference(self::STATUS_CREATE, $status);
    }

    private function createOpened(ObjectManager $manager)
    {
        $status = new Status();
        $status->setName("Ouverte");

        $manager->persist($status);
        $manager->flush();

        $this->addReference(self::STATUS_OPENED, $status);
    }

    private function createClosed(ObjectManager $manager)
    {
        $status = new Status();
        $status->setName("Clôturée");

        $manager->persist($status);
        $manager->flush();

        $this->addReference(self::STATUS_CLOSED, $status);
    }

    private function createCurrent(ObjectManager $manager)
    {
        $status = new Status();
        $status->setName("Activitée en cours");

        $manager->persist($status);
        $manager->flush();

        $this->addReference(self::STATUS_CURRENT, $status);
    }

    private function createPast(ObjectManager $manager)
    {
        $status = new Status();
        $status->setName("Passée");

        $manager->persist($status);
        $manager->flush();

        $this->addReference(self::STATUS_PAST, $status);
    }

    private function createCancelled(ObjectManager $manager)
    {
        $status = new Status();
        $status->setName("Annulée");

        $manager->persist($status);
        $manager->flush();

        $this->addReference(self::STATUS_CANCELLED, $status);
    }

    private function createCreationInProgress(ObjectManager $manager)
    {
        $status = new Status();
        $status->setName("Création en cours");

        $manager->persist($status);
        $manager->flush();

        $this->addReference(self::STATUS_CREATION_IN_PROGRESS, $status);
    }
}