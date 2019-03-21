<?php 
namespace App\DataFixtures;
// src/DataFixtures/UserFixtures.php
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
// ...

class UserFixtures extends Fixture
{
     private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        // ...
         $user->setPassword($this->passwordEncoder->encodePassword($user, '12345'));
         $user->setEmail('admin@example.com');
         $user->setRoles(array('ROLE_ADMIN'));
         $manager->persist($user);
         $manager->flush();

        
        // ...
    }
}
