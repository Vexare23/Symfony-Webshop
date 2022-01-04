<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoadUsers extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    /*
    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            ->afterInstantiate(function(User $user) {
                if ($user->getPlainPassword()) {
                    $user->setPassword(
                        $this->passwordHasher->hashPassword($user, $user->getPlainPassword())
                    );
                }
            })
            ;
    }
    */

    public function load(ObjectManager $manager)
    {
        $users = [
            [
                'email' => 'faker@gmail.com',
                '$passwordHasher' => 'admin',
                'roles' => 'ROLE_ADMIN'
            ],
            [
                'email' => 'squid@gmail.com',
                '$passwordHasher' => 'dada',
                'roles' => 'ROLE_USER'

            ],
            [
                'email' => 'gamer@gmail.com',
                '$passwordHasher' => 'tada',
                'roles' => 'ROLE_USER'
            ],
        ];

        foreach ($users as $userValue) {

            $user = new User();
            $user->setEmail($userValue['email']);
            $user->setPassword($userValue['$passwordHasher']);

            if ($userValue['roles'])
            {
                $user->setRoles([$userValue['roles']]);
            }

            $manager->persist($user);
        }
        $manager->flush();
    }
}