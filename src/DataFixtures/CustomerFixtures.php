<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class CustomerFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::Create('fr_FR');

        for($i = 0; $i < 10; ++$i) {
            $supplier = new Customer();
            $supplier
                ->setName($faker->name())
                ->setEmail($faker->email())
                ->setPhoneNumber($faker->phoneNumber());

            $manager->persist($supplier);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return [
            'humanFixtures'
        ];
    }
}
