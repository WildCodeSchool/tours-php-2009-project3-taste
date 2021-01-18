<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('en_US');

        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($faker->firstName);
            $category->setDescription($faker->realText(20));
            $this->addReference('category_' . $i, $category);
            $manager->persist($category);
        }
        $category = new Category();
        $category->setName($faker->lastName);
        $category->setDescription($faker->realText(40));
        $category->setMinPrice($faker->randomFloat(3, 2, 15));
        $category->setMaxPrice($faker->randomFloat(3, 2, 15));
        $this->addReference('category_' . $i, $category);
        $manager->persist($category);

        $manager->flush();
    }
}
