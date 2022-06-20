<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class PharmacyTest extends ApiTestCase{

    public function testCreateProduct(){
        $this->createPharmacy();
    }

    public function testUpdateProduct(){
        $id = $this->createPharmacy();
        $client = static::createClient();        
        $client->request('PUT', '/api/pharmacies/'.$id,['json'=>[
                    // "id"=>$id,
                    "name"=>"Al ezaby",
                    "address"=>"Maadi Giza",
                ]]);
     
        $this->assertResponseStatusCodeSame('200');          
    }

    public function testDeleteProduct(){
        $client = static::createClient();
        $id = $this->createPharmacy();   

        $client = static::createClient();
        $client->request('DELETE', '/api/pharmacies/'.$id);
     
        $this->assertResponseStatusCodeSame('204');           
    }

    private function createPharmacy(){
        $client = static::createClient();
        $client->request('POST', '/api/pharmacies',['json'=>[
            "name"=>"Al ezaby",
            "address"=>"Maadi Giza",
            "price"=>"150.00"              
        ]]);
     
        $this->assertResponseStatusCodeSame('201');   
        return json_decode($client->getResponse()->getContent())->id;
    }

}