<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ProductController extends AbstractController
{

    private $repo;

    public function __construct(ProductRepository $productRepo){
        $this->repo = $productRepo;
    }

    #[Route ('/api/product/get/{id}',name:'getProduct')]
    public function getProduct($id){
        $result = $this->repo->findProducts($id);
        return $this->render('products/single.html.twig', [
            'product' => $result
        ]);
    }

    #[Route ('/api/product/search',name:'searchProduct')]
    public function searchProduct(Request $request)
    {
        $result ='';
        if($request->getContent()) {

            if($this->isJson($request->getContent())){
                $search = json_decode($request->getContent(),true)['search'];
            }else{
                $search = str_replace('search=','',$request->getContent());
            }
            if (empty($search)){
                throw new BadRequestHttpException('Please Enter Keywords');
            }
            $result = $this->repo->findAllWithSearch($search);
        }

        return $this->render('products/index.html.twig', [
            'products' => $result
        ]);
    }

    private function isJson($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
     }
}