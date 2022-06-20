<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProdctPharmacyRepository;

#[ApiResource]
#[ORM\Entity(repositoryClass: ProdctPharmacyRepository::class)]
class ProdctPharmacy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $price;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $available;

    #[ORM\ManyToOne(targetEntity:'Product',inversedBy:'productOfPharmacy')]
    #[ORM\JoinColumn(nullable:false)]
    private $product;

    #[ORM\ManyToOne(targetEntity:'Pharmacy',inversedBy:'pharmacyOfProduct')]
    #[ORM\JoinColumn(nullable:false)]
    private $pharmacy;    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function isAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(?bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getProduct(){
        return $this->product;
    }

    public function setProduct($product){
        $this->product = $product;
    }

    public function getPharmacy(){
        return $this->pharmacy;
    }

    public function setPharmacy($pharmacy){
        $this->pharmacy = $pharmacy;
    }      
}
