<?php

namespace App\Tests;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class ProductPharmacyTest extends ApiTestCase{

    public function testCreateProductPharmacy(){
        $pharmacyId = $this->createPharmacy();
        $productId = $this->createProduct();
        $this->createProductPharmacy($pharmacyId,$productId);
    }

    private function createProductPharmacy($pharmacyId,$productId){
        $this->faker = Factory::create();
        $client = static::createClient();
        $client->request('POST', '/api/prodct_pharmacies',['json'=>[
            "product"=>'api/products/'.$productId,
            "pharmacy"=>'api/pharmacies/'.$pharmacyId,
            "price"=>strval($this->faker->numberBetween(150, 250)),
            "available"=>true              
        ]]);
     
        $this->assertResponseStatusCodeSame('201');   
        return json_decode($client->getResponse()->getContent())->id;
    }

    private function createPharmacy(){
        $this->faker = Factory::create();
        $client = static::createClient();
        $client->request('POST', '/api/pharmacies',['json'=>[
            "name"=>"Al ezaby",
            "address"=>"Maadi Giza",
            "price"=>strval($this->faker->numberBetween(150, 250))              
        ]]);
     
        $this->assertResponseStatusCodeSame('201');   
        return json_decode($client->getResponse()->getContent())->id;
    }

    private function createProduct(){
        $this->faker = Factory::create();
        $file = new UploadedFile(__DIR__.'/../fixtures/files/mario_PNG125.png', 'image.png');
        $client = static::createClient();
        $client->request('POST', '/api/products',[
            'headers' => ['Content-Type' => 'multipart/form-data'],
            'extra' => [
                'parameters' => [
                    "title"=>"Panadol Tabs zaki",
                    "description"=>"Panadol for headaches and pains",
                    "price"=>strval($this->faker->numberBetween(150, 250)),
                    "quantity"=>$this->faker->numberBetween(10, 20)                
                ],
                'files' => [
                    "image"=>$file,
                ]
            ]
        ]);
     
        $this->assertResponseStatusCodeSame('201');   
        return json_decode($client->getResponse()->getContent())->id;
    }
}