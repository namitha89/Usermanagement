<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
	
        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        //$this->addReference(self::ADMIN_USER_REFERENCE, $userAdmin);
        
    }
}
