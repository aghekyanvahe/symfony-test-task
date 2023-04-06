<?php

namespace App\DataFixtures;

use App\SkyBundle\Entity\Galaxy;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
                $galaxy = new Galaxy();
                $galaxy->setName('earth '.$i);
                $galaxy->setRadius(mt_rand(10, 100));
                $galaxy->setTemperature(mt_rand(10, 100));
                $galaxy->setRotationFrequency(mt_rand(10, 100));

                $manager->persist($galaxy);
        }

        $manager->flush();
    }
}
