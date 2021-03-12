<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\HotelFixtures;
use Faker\Factory;
use App\Entity\Review;

class ReviewFixtures extends Fixture implements DependentFixtureInterface
{
    private static $commentsDemo = ['Double deposit taken from bank',
'Super disappointed!',
'Dissatisfied Hilton gold number',
'Wouldnt refund even though a government ban on travel!',
'Stay away, you can not trust them',
'Only sty here if nothing else is available in london',
'Rude staff',
'Just plain awful staff attitude !!!!',
'Terrible Experience',
'In desperate need of a refurb!',
'Totally unacceptable. Filthy.',
'Worst hotel i have ever stayed in',
'Avoid level 4 at any cost..',
'Stay clear al- staff attitude appalling',
'Airport stop over',
'Building work outside of room window',
'Extremely disappointing',
'Needs knocking down',
'Terrible experience',
'Noisy air con',
'Avoid',
'Work trip',
'Shockingly poor experience', 
'Appalling Service from Check In Manager',
'Ruined London Trip',
'AVOID',
'Filthy room',
'Appalled',
'Beautiful hotel, but too many plastics!!', 
'Poor standard - Poor Service',
'Stinking mouldy room',
'An overpriced terrible nights sleep!',
'Bad hotel',
'AVOID!!!',
'No value for money, false firealarm in the middle of the night, no apologies',
'Utterly Disgusting',
'Awful..am HHonors member & wouldnot recommend',
'Room needs an urgent refurb',
'Woeful service',
'Unsafe, and poor overall staff service',
'Will not ever go back as dirty rooms',
'Utterly disgraceful filthy rotting worn out property with worst service do not stay here',
'Absolute disgrace',
'Terrible experience with unclean room with flies',
'Appalling ',
'Stay Away',
'Worst hotel EVER!',
'Not impressed with the room', 
'Very tired old dirty hotel',
'Burning hot and noisy rooms',
'Air conditioner wasnt working & no effort to fix it',
'Awful',
'Crumbling overpriced and dirty',
'What an absolute tip',
'Wish it had been better for the price.',
'Worst night EVER!!!',
'HONORS DIAMOND MEMBER'];

        
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);

        // make sure that each of the 10 hotels has at least a review
        for ($i = 0; $i < 10; $i++) {
            $hotel = $this->getReference(HotelFixtures::getReferenceKey($i));
            $randScore = random_int(1, 5);            
            $randCreatedDate = $faker->dateTimeBetween('-730 days', '-1 days');
            
            $review = new Review();
            $review->setComment($faker->randomElement(self::$commentsDemo));
            $review->setCreatedDate($randCreatedDate);
            $review->setHotel($hotel);
            $review->setScore($randScore);
            $manager->persist($review);            
        }
        $batchSize = 200;
        // randomly fill the data for the rest of hotels from 100,000 that are 99,990 hotels
        for ($j = 0; $j < 99990; $j++) {
            $randHotel = random_int(1, 9);
            $hotel = $this->getReference(HotelFixtures::getReferenceKey($randHotel));
            
            $randScore = random_int(1, 5);
            $randCreatedDate = $faker->dateTimeBetween('-730 days', '-1 days');

            
            $review = new Review();
            $review->setComment($faker->randomElement(self::$commentsDemo));
            $review->setCreatedDate($randCreatedDate);
            $review->setHotel($hotel);
            $review->setScore($randScore);
            if (($i % $batchSize) === 0) {
                $manager->flush();
                $manager->clear(); // Detaches all objects from Doctrine!
            }
            $manager->persist($review);
        }
        $manager->flush();
        $manager->clear();
    }
    
    private function getRandomDateLastTwoYears() : string
    {
        // get a random date from last 2 years
        $lastTwoYearsTime = strtotime("-2 year");
        $randCreatedDateNumber = mt_rand($lastTwoYearsTime, time());
        $randCreatedDate = date("Y-m-d H:i:s",$randCreatedDateNumber);

        return $randCreatedDate;
    }
    
    public function getDependencies()
    {
        return [
        HotelFixtures::class,
        ];
    }
}