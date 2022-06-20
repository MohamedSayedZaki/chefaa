<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Controller\ProductPostAction;
use App\Repository\ProductRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ApiResource(collectionOperations: ['get','post' => ['method'=>'POST','controller' => ProductPostAction::class,'deserialize' => false]])]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'string', length: 255)]
    private $price;

    #[ORM\Column(type: 'string', length: 255)]
    private $quantity;

    #[ORM\OneToMany(targetEntity:"ProdctPharmacy",mappedBy:"product")]
    private $productOfPharmacy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
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

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }    
    
    public function getProductOfPharmacy(){
        return $this->productOfPharmacy;
    }
}
