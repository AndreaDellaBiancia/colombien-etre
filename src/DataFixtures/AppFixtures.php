<?php

namespace App\DataFixtures;

use App\Entity\Autohypnose;
use App\Entity\BachFlower;
use App\Entity\Feed;
use App\Entity\Massage;
use App\Entity\Meditation;
use App\Entity\Perma;
use App\Entity\Phyto;
use App\Entity\Product;
use App\Entity\Reiki;
use App\Entity\Sport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\Medical;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void

    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 30; $i++) {

            $product = new Product();
            $product->setTitle($faker->sentence($nbWords = 4, $variableNbWords = true));
            $product->setBrand($faker->word);
            $product->setPrice(mt_rand(1, 50));
            $product->setPicture($faker->imageUrl);
            $product->setSource($faker->url);
            $product->setCreatedAt((new \DateTimeImmutable()));
            $product->setCategory(mt_rand(0, 1) ? 'hygiene' : 'beauté');


            $auto = new Autohypnose();
            $auto->setTitle($faker->sentence($nbWords = 4, $variableNbWords = true));
            $auto->setContent($faker->sentence($nbWords = 300, $variableNbWords = true));
            $auto->setThumbnailPicture($faker->imageUrl);
            $auto->setMainPicture($faker->imageUrl);
            $auto->setAuthor($faker->word);
            $auto->setSource($faker->url);
            $auto->setCreatedAt((new \DateTimeImmutable()));

            $bach = new BachFlower();
            $bach->setTitle($faker->sentence($nbWords = 4, $variableNbWords = true));
            $bach->setContent($faker->sentence($nbWords = 300, $variableNbWords = true));
            $bach->setThumbnailPicture($faker->imageUrl);
            $bach->setMainPicture($faker->imageUrl);
            $bach->setAuthor($faker->word);
            $bach->setSource($faker->url);
            $bach->setCreatedAt((new \DateTimeImmutable()));

            $feed = new Feed();
            $feed->setTitle($faker->sentence($nbWords = 4, $variableNbWords = true));
            $feed->setContent($faker->sentence($nbWords = 300, $variableNbWords = true));
            $feed->setThumbnailPicture($faker->imageUrl);
            $feed->setMainPicture($faker->imageUrl);
            $feed->setAuthor($faker->word);
            $feed->setSource($faker->url);
            $feed->setCreatedAt((new \DateTimeImmutable()));

            $massage = new Massage();
            $massage->setTitle($faker->sentence($nbWords = 4, $variableNbWords = true));
            $massage->setContent($faker->sentence($nbWords = 300, $variableNbWords = true));
            $massage->setThumbnailPicture($faker->imageUrl);
            $massage->setMainPicture($faker->imageUrl);
            $massage->setAuthor($faker->word);
            $massage->setSource($faker->url);
            $massage->setCreatedAt((new \DateTimeImmutable()));

            $meditation = new Meditation();

            $meditation->setTitle($faker->sentence($nbWords = 4, $variableNbWords = true));
            $meditation->setContent($faker->sentence($nbWords = 300, $variableNbWords = true));
            $meditation->setThumbnailPicture($faker->imageUrl);
            $meditation->setMainPicture($faker->imageUrl);
            $meditation->setAuthor($faker->word);
            $meditation->setSource($faker->url);
            $meditation->setCreatedAt((new \DateTimeImmutable()));

            $perma = new Perma();
            $perma->setTitle($faker->sentence($nbWords = 4, $variableNbWords = true));
            $perma->setContent($faker->sentence($nbWords = 300, $variableNbWords = true));
            $perma->setThumbnailPicture($faker->imageUrl);
            $perma->setMainPicture($faker->imageUrl);
            $perma->setAuthor($faker->word);
            $perma->setSource($faker->url);
            $perma->setCreatedAt((new \DateTimeImmutable()));

            $phyto = new Phyto();
            $phyto->setTitle($faker->sentence($nbWords = 4, $variableNbWords = true));
            $phyto->setContent($faker->sentence($nbWords = 300, $variableNbWords = true));
            $phyto->setThumbnailPicture($faker->imageUrl);
            $phyto->setMainPicture($faker->imageUrl);
            $phyto->setAuthor($faker->word);
            $phyto->setSource($faker->url);
            $phyto->setCreatedAt((new \DateTimeImmutable()));

            $reiki = new Reiki();
            $reiki->setTitle($faker->sentence($nbWords = 4, $variableNbWords = true));
            $reiki->setContent($faker->sentence($nbWords = 300, $variableNbWords = true));
            $reiki->setThumbnailPicture($faker->imageUrl);
            $reiki->setMainPicture($faker->imageUrl);
            $reiki->setAuthor($faker->word);
            $reiki->setSource($faker->url);
            $reiki->setCreatedAt((new \DateTimeImmutable()));

            $sport = new Sport();
            $sport->setTitle($faker->sentence($nbWords = 4, $variableNbWords = true));
            $sport->setContent($faker->sentence($nbWords = 300, $variableNbWords = true));
            $sport->setThumbnailPicture($faker->imageUrl);
            $sport->setMainPicture($faker->imageUrl);
            $sport->setAuthor($faker->word);
            $sport->setSource($faker->url);
            $sport->setCreatedAt((new \DateTimeImmutable()));




            $manager->persist($product);
            $manager->persist($auto);
            $manager->persist($bach);
            $manager->persist($feed);
            $manager->persist($massage);
            $manager->persist($meditation);
            $manager->persist($perma);
            $manager->persist($reiki);
            $manager->persist($sport);
            $manager->persist($phyto);
        }
        $manager->flush();
    }
}
