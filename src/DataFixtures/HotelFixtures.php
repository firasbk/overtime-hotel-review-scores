<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Hotel;

class HotelFixtures extends Fixture
{
    public static function getReferenceKey($i){
        return sprintf('hotel_%s', $i);
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $hotel = new Hotel();
            $hotel->setName($faker->name);
            $manager->persist($hotel);
            $this->addReference(self::getReferenceKey($i), $hotel);        
        }
        $manager->flush();
    }
    
    private function getRandomDateLastTwoYears() : string
    {
        // get a random date from last 2 years
        $lastTwoYearsTime = strtotime("-2 year");
        $randCreatedDateNumber = mt_rand($lastTwoYearsTime, time());
        $randCreatedDate = date("Y-m-d H:i:s",$randCreatedDateNumber);

        return $randCreatedDate;
    }
}