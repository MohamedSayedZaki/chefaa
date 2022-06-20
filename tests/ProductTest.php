<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class ProductTest extends ApiTestCase{

    public function testCreateProduct(){
        $this->createProduct();   
    }

    public function testUpdateProduct(){
        $id = $this->createProduct();   
        $client = static::createClient();
        $client->request('PUT', '/api/products/'.$id,['json'=>[
                    "id"=>$id,
                    "title"=>"Panadol Tabs",
                    "description"=>"Panadol for Pains",
                    "price"=>"150.00",
                    "quantity"=>"30"                
                ]]);
     
        $this->assertResponseStatusCodeSame('200');          
    }

    public function testDeleteProduct(){
        $id = $this->createProduct();            
        $client = static::createClient();
        $client->request('DELETE', '/api/products/'.$id);
     
        $this->assertResponseStatusCodeSame('204');           
    }

    private function createProduct(){
        $file = new UploadedFile(__DIR__.'/../fixtures/files/mario_PNG125.png', 'image.png');
        $client = static::createClient();
        $client->request('POST', '/api/products',[
            'headers' => ['Content-Type' => 'multipart/form-data'],
            'extra' => [
                'parameters' => [
                    "title"=>"Panadol Tabs",
                    "description"=>"Panadol for headaches and pains",
                    "price"=>"50.00",
                    "quantity"=>"20"                
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