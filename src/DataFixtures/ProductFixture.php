<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Faker\Factory;
use Faker\Provider\en_US\Text;

class ProductFixture extends Fixture
{

    protected $faker;

    public function load(ObjectManager $manager): void
    {

        $this->faker = Factory::create();

        for($i=0;$i<50000;$i++){
            $file = new UploadedFile(__DIR__.'/../../fixtures/files/mario_PNG125.png', 'image.png');
            $product = new Product();
            $product->setTitle('Panadol Extra '.$this->faker->name);
            $product->setDescription($this->faker->realText($maxNbChars = 100, $indexSize = 2));
            $product->setPrice($this->faker->numberBetween(15, 25));
            $product->setImage($file);
            $product->setQuantity($this->faker->numberBetween(50, 100));     
            $manager->persist($product);
        }   

        $manager->flush();
    }
}
