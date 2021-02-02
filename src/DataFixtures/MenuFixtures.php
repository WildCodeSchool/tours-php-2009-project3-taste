<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class MenuFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*$faker = Faker\Factory::create('en_US');

        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setName($faker->lastName);
            $product->setCategory($this->getReference('category_' . $faker->regexify('[0-4]')));
            $product->setPrice($faker->randomFloat(2, 1, 10));
            $product->setIngredients($faker->name);
            $product->setGroupName($faker->name);
            $product->setGroupDescription($faker->realText(40, 2));
            $manager->persist($product);
        }
        $manager->flush();*/
    }
}
