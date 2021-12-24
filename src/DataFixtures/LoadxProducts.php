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
                'categor' => LoadCategories::NAME_FOOD
            ],
            [
                'name' => 'Fish',
                'categor' => LoadCategories::NAME_FOOD
            ],
            [
                'name' => 'Water',
                'categor' => LoadCategories::NAME_DRINKS
            ],
            [
                'name' => 'Cola',
                'categor' => LoadCategories::NAME_DRINKS
            ],
            [
                'name' => 'Sugar',
                'categor' => LoadCategories::NAME_ACCESSORIES
            ]
        ];

        foreach ($products as $productsValues) {

            $product = new Product();
            $product->setName($productsValues['name']);
            $product->setPrice(mt_rand(10, 100));

            if($productsValues['categor']==(LoadCategories::NAME_FOOD)){
                $product->setCategory($this->getReference(LoadCategories::NAME_FOOD));
                $product->addTag($this->getReference(LoadTags::NAME_Tag1));
                $product->addTag($this->getReference(LoadTags::NAME_Tag2));
            }

            if($productsValues['categor']==(LoadCategories::NAME_DRINKS)){
                $product->setCategory($this->getReference(LoadCategories::NAME_DRINKS));
                $product->addTag($this->getReference(LoadTags::NAME_Tag2));
                $product->addTag($this->getReference(LoadTags::NAME_Tag3));
            }

            if($productsValues['categor']==(LoadCategories::NAME_ACCESSORIES)){
                $product->setCategory($this->getReference(LoadCategories::NAME_ACCESSORIES));
                $product->addTag($this->getReference(LoadTags::NAME_Tag1));
                $product->addTag($this->getReference(LoadTags::NAME_Tag3));
            }
            $manager->persist($product);
        }
        $manager->flush();
    }
}