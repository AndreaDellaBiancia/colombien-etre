<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void

    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {

            $product = new Product();
            $product->setTitle($faker->sentence);
            $product->setBrand($faker->word);
            $product->setPrice(mt_rand(1, 50)) ;

            $product->setPicture($faker->imageUrl);
            $product->setSource($faker->url);
            $product->setCreatedAt((new \DateTimeImmutable()));
            $product->setUpdatedAt((new \DateTimeImmutable()));

            $product->setTag(mt_rand(0, 1) ? 'hygiene' : 'beauté'  );


            $manager->persist($product);
        }
        $manager->flush();
    }
}
