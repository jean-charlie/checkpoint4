<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategorieFixtures extends Fixture
{
    const CATEGORIES = [
        'Impressioniste',
        'Abstrait',
        'Comtemporin',
    ];
    
    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $key => $categoryNom) {
            $category = new Categorie();
            $category->setNom($categoryNom);

            $manager->persist($category);
        }
        $manager->flush();
    }
}