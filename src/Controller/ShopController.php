<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/boutique", name="shop")
     */
    public function index(ProductRepository $productRepository): Response
    {
        $allProducts = $productRepository->findAll();
        $allProductsNb = count($allProducts);
        return $this->render('front/shop/index.html.twig', [
           'products' => $allProducts,
           'totalProducts' => $allProductsNb
        ]);
    }
}
