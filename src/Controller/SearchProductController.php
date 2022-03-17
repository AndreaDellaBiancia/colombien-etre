<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

class SearchProductController extends AbstractController
{
    /**
     * @Route("/search", name="searchProduct")
     */
    public function index(ProductRepository $productRepository): Response
    {       
         $searchTerm = $_GET['q'];
        
        $results = $productRepository->findAllBySearchTerm($searchTerm);
        $resultsNb = count($results);
        $allProducts = $productRepository->findAll();
        $allProductsNb = count($allProducts);
        
        if($results == true){
            return $this->render('front/shop/index.html.twig', [
                'products' =>  $results,
                'foundProducts' => $resultsNb,
                'searchTerm' => $searchTerm,
                'totalProducts' => $allProductsNb
             ]);
        }else{
            return $this->render('front/shop/index.html.twig', [
                'products' => $allProducts,
                'totalProducts' => $allProductsNb
             ]);
        }
        
       
    }
}
