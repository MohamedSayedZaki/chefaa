<?php

namespace App\DataFixtures;
ini_set('memory_limit', '-1');
use Faker\Factory;
use App\Entity\Pharmacy;
use Faker\Provider\en_US\Text;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Provider\en_US\Address;

class PharmacyFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();

        for($i=0;$i<20000;$i++){
            $pharmacy = new Pharmacy();
            $pharmacy->setName($this->faker->name);
            $pharmacy->setAddress($this->faker->address);
            $manager->persist($pharmacy);
        }   

        $manager->flush();
    }
}
