<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\DataFixtures\LoadTags;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadxProducts extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $products = [
            [
                'name' => 'Bread',
                'categor' => LoadCategories::NAME_FOOD,
                'tags' => [LoadTags::NAME_Tag1, LoadTags::NAME_Tag2]
            ],
            [
                'name' => 'Fish',
                'categor' => LoadCategories::NAME_FOOD,
                 'tags' => [LoadTags::NAME_Tag1, LoadTags::NAME_Tag2]
            ],
            [
                'name' => 'Water',
                'categor' => LoadCategories::NAME_DRINKS,
                 'tags' => [LoadTags::NAME_Tag2, LoadTags::NAME_Tag3]
            ],
            [
                'name' => 'Cola',
                'categor' => LoadCategories::NAME_DRINKS,
                 'tags' => [LoadTags::NAME_Tag2, LoadTags::NAME_Tag3]
            ],
            [
                'name' => 'Sugar',
                'categor' => LoadCategories::NAME_ACCESSORIES,
                'tags' => [LoadTags::NAME_Tag1, LoadTags::NAME_Tag3]
            ]
        ];

        foreach ($products as $productsValues) {

            $product = new Product();
            $product->setName($productsValues['name']);
            $product->setPrice(mt_rand(10, 100));

            $product->setCategory($this->getReference($productsValues['categor']));
            foreach ($productsValues['tags'] as $tag)
                {
                    $product->addTag($this->getReference($tag));
                }

            $manager->persist($product);
        }
        $manager->flush();
    }
}
