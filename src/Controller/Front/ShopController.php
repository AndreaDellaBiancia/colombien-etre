<?php

namespace App\Controller\Front;


use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class ShopController extends AbstractController
{
    /**
     * @Route("/boutique", name="shop")
     */
    public function index(ProductRepository $productRepository, Request $request, PaginatorInterface $paginator): Response
    {
        
        $items = $productRepository->findBy([], ['id' => 'DESC']);
        $allProductsNb = count($items);

        $allProducts = $paginator->paginate(
            $items,
            $request->query->getInt('page', 1),
            16
        );


        return $this->render('front/shop/index.html.twig', [
           'products' => $allProducts,
           'totalProducts' => $allProductsNb
        ]);
    }
}
