<?php

namespace App\DataFixtures;

use App\Entity\Peinture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PeinturesFixtures extends Fixture
{
    const PEINTURES = [
        'Peter',
        'Marco',
        'Polo',
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::PEINTURES as $key => $peintureNom) {
            $peinture = new Peinture();
            $peinture->setNom($peintureNom);

            $manager->persist($peinture);
        }
        $manager->flush();
    }
}
