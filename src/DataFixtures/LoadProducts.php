<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadProducts extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $products = [
            [
                'name' => 'Bread',
                'categor' => 'Food'
            ],
            [
                'name' => 'Fish',
                'categor' => 'Food'
            ],
            [
                'name' => 'Water',
                'categor' => 'Drinks'
            ],
            [
                'name' => 'Cola',
                'categor' => 'Drinks'
            ],
            [
                'name' => 'Sugar',
                'categor' => 'Accessories'
            ]
        ];
        //dd($categories);
        foreach ($products as $productsValues) {
            // Create Category object and set values from $categoryValues
            $product = new Product();
            $product->setName($productsValues['name']);
            $product->setPrice(mt_rand(10, 100));
            // Set reference
            if($productsValues['categor']==(LoadCategories::NAME_FOOD)){
                $product->setCategory($this->getReference(LoadCategories::NAME_FOOD));
            }
            if($productsValues['categor']==(LoadCategories::NAME_DRINKS)){
                $product->setCategory($this->getReference(LoadCategories::NAME_DRINKS));
            }
            if($productsValues['categor']==(LoadCategories::NAME_ACCESSORIES)){
                $product->setCategory($this->getReference(LoadCategories::NAME_ACCESSORIES));
            }
            //$category->addProduct($product);
            //$this->addReference(self::NAME_Bread, $product);
            //$this->addReference(self::NAME_Cola, $product);
            //$this->addReference(self::NAME_Sugar, $product);
            $manager->persist($product);
        }
        $manager->flush();
    }
}
