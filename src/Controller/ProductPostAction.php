<?php
// api/src/Controller/ProductPostAction.php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class ProductPostAction
{
    public function __invoke(Request $request): Product
    {
        $uploadedFile = $request->files->get('image');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $title = $request->get('title');
        $description = $request->get('description');
        $price = $request->get('price');
        $quantity = $request->get('quantity');

        $product = new Product;
        $product->setTitle($title);
        $product->setDescription($description);
        $product->setPrice($price);
        $product->setQuantity($quantity);
        $product->setImage($uploadedFile->getFilename());

        return $product;
    }
}