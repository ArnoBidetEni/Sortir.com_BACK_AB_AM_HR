<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use App\Entity\Participant;

class ParticipantFixtures extends Fixture implements DependentFixtureInterface
{
    public const ADMIN_USER = "admin";
    public const USER_1 = "user_1";
    public const USER_2 = "user_2";
    public const USER_3 = "user_3";
    public const USER_4 = "user_4";
    public const USER_5 = "user_5";

    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ){}

    public function load(ObjectManager $manager): void
    {
        $this->createAdmin($manager);
        $this->createUser1($manager);
        $this->createUser2($manager);
        $this->createUser3($manager);
        $this->createUser4($manager);
        $this->createUser5($manager);
    }

    private function createAdmin($manager)
    {
        $admin = new Participant();
        $admin->setLastName("Admin");
        $admin->setFirstName("Admin");
        $admin->setLogin('admin');
        $admin->setAdministrator(true);
        $admin->setActive(true);
        $admin->setPhoneNumber('0102030405');
        $admin->setMail("administrator@campus-eni.fr");
        $admin->setCampus($this->getReference(CampusFixtures::CAMPUS_SAINT_HERBLAIN));

        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            "pwd"
        );

        $admin->setPassword($hashedPassword);

        $manager->persist($admin);
        $manager->flush();

        $this->addReference(self::ADMIN_USER, $admin);
    }

    private function createUser1($manager)
    {
        $user = new Participant();
        $user->setLastName("Spinoza");
        $user->setFirstName("Baruch");
        $user->setLogin('bspinoza');
        $user->setAdministrator(true);
        $user->setActive(true);
        $user->setPhoneNumber('0508080808');
        $user->setMail("spinoza@gmail.com");
        $user->setCampus($this->getReference(CampusFixtures::CAMPUS_SAINT_HERBLAIN));

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            "pwd"
        );

        $user->setPassword($hashedPassword);

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::USER_1, $user);
    }

    private function createUser2($manager)
    {
        $user = new Participant();
        $user->setLastName("Sansamis");
        $user->setFirstName("Rémy");
        $user->setLogin('rsansamis');
        $user->setAdministrator(false);
        $user->setActive(true);
        $user->setPhoneNumber('0508080809');
        $user->setMail("remy@gmail.com");
        $user->setCampus($this->getReference(CampusFixtures::CAMPUS_SAINT_HERBLAIN));

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            "pwd"
        );

        $user->setPassword($hashedPassword);

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::USER_2, $user);
    }

    private function createUser3($manager)
    {
        $user = new Participant();
        $user->setLastName("Jojo");
        $user->setFirstName("Joestar");
        $user->setLogin('jjoestar');
        $user->setAdministrator(false);
        $user->setActive(true);
        $user->setPhoneNumber('0508080810');
        $user->setMail("jojo@gmail.com");
        $user->setCampus($this->getReference(CampusFixtures::CAMPUS_SAINT_HERBLAIN));

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            "pwd"
        );

        $user->setPassword($hashedPassword);

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::USER_3, $user);
    }

    private function createUser4($manager)
    {
        $user = new Participant();
        $user->setLastName("Dertre");
        $user->setFirstName("Bertrand");
        $user->setLogin('bdertre');
        $user->setAdministrator(false);
        $user->setActive(true);
        $user->setPhoneNumber('0508080811');
        $user->setMail("bertrand@gmail.com");
        $user->setCampus($this->getReference(CampusFixtures::CAMPUS_SAINT_HERBLAIN));

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            "pwd"
        );

        $user->setPassword($hashedPassword);

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::USER_4, $user);
    }

    private function createUser5($manager)
    {
        $user = new Participant();
        $user->setLastName("Lafarge");
        $user->setFirstName("Jeanine");
        $user->setLogin('jlafarge');
        $user->setAdministrator(false);
        $user->setActive(true);
        $user->setPhoneNumber('0508080812');
        $user->setMail("lafarge@gmail.com");
        $user->setCampus($this->getReference(CampusFixtures::CAMPUS_SAINT_HERBLAIN));

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            "pwd"
        );

        $user->setPassword($hashedPassword);

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::USER_5, $user);
    }

    public function getDependencies()
    {
        return [
            CampusFixtures::class,
        ];
    }
}