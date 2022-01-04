<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category1;
use App\Factory\Category1Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadCategories extends Fixture
{
    public const NAME_FOOD = 'Food';
    public const NAME_DRINKS = 'Drinks';
    public const NAME_ACCESSORIES = 'Accessories';

    public function load(ObjectManager $manager)
    {
        $categories = [
            [
                'name' => self::NAME_FOOD
            ],
            [
                'name' => self::NAME_DRINKS
            ],
            [
                'name' => self::NAME_ACCESSORIES
            ]
        ];
        //dd($categories);
        foreach ($categories as $categoryValues) {
            // Create Category object and set values from $categoryValues
            $category = new Category1();
            $category->setName($categoryValues['name']);
            $manager->persist($category);
            // Set reference
            $this->addReference($categoryValues['name'], $category);
        }
        //Category1Factory::createMany(6);

        $manager->flush();
    }
}
