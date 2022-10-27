<?php

namespace App\DataFixtures;

use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

class ParticipantFixtures extends Fixture
{
    public function __construct(
        private ObjectManager $manager
    ){}

    public function load(): void
    {
        $this->createAdmin();
    }

    private function createAdmin()
    {
        $admin = new Participant();

        $admin->setName("Admin");
        $admin->setFirstName("Admin");
        $admin->setLogin('administrator');
        $admin->setAdministrator(true);
        $admin->setActive(true);
        $admin->setPhoneNumber('0102030405');
        $admin->setMail("administrator@campus-eni.fr");
        $admin->setCampus($campus);

        $hashedPassword = $passwordHasher->hashPassword(
            $admin,
            $password
        );

        $admin->setPassword($hashedPassword);

        $this->manager->persist($admin);
        $this->manager->flush();
    }
}
