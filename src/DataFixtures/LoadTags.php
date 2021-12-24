<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadTags extends Fixture
{
    public const NAME_Tag1 = 'Tag1';
    public const NAME_Tag2 = 'Tag2';
    public const NAME_Tag3 = 'Tag3';

    public function load(ObjectManager $manager)
    {
        $tags = [
            [
                'name' => self::NAME_Tag1
            ],
            [
                'name' => self::NAME_Tag2
            ],
            [
                'name' => self::NAME_Tag3
            ]
        ];

        foreach ($tags as $tagValue){
            $tag = new Tag();
            $tag->setName($tagValue['name']);
            $manager->persist($tag);
            $this->addReference($tagValue['name'], $tag);
        }
        $manager->flush();
    }
}