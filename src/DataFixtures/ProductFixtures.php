<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Supplier;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $suppliers = $manager->getRepository(Supplier::class)->findBy([], [], 10);

        $faker = \Faker\Factory::Create('fr_FR');

        for($i = 0; $i < 10; ++$i) {
            $product = new Product();
            $product
                ->setReference('REF' . $faker->isbn10())
                ->setName($faker->sentence(2))
                ->setDescription($faker->paragraphs(3, true))
                ->setPrice($faker->randomFloat(2, 1, 100))
                ->setDiscount($faker->numberBetween(0, 20))
                ->setSupplier($suppliers[array_rand($suppliers, 1)]);

            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [SupplierFixtures::class];
    }
}
