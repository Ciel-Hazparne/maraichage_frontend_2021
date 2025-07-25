<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
    $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();
         for($i=0; $i<=20; $i++)
         {
             $product = new Produit();
             $product->setNom($faker->word)
                    ->setPrix($faker->numberBetween(1,10))
                    ->setQuantite($faker->numberBetween(1,10));
             $manager->persist($product);

         }



         for($i = 1; $i<=10; $i++){
             $user=new User();
$password=$this->encoder->encodePassword($user,"admin");
             $user->setEmail($faker->email)
                    ->setPassword($password);

             $manager->persist($user);
         }
        $manager->flush();
    }



}
