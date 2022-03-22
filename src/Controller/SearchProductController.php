<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class SearchProductController extends AbstractController
{
    /**
     * @Route("/boutique/search", name="searchProduct")
     */
    public function index(ProductRepository $productRepository, Request $request, PaginatorInterface $paginator): Response
    {

        if (isset($_GET['q'])) {
            $searchTerm = $_GET['q'];
            $items = $productRepository->findAllBySearchTerm($searchTerm);

        } elseif (isset($_GET['category']) and !empty($_GET['category'])) {
            $searchCategories = $_GET['category'];

            //Je recupere un tableau multidimensionnel avec des sous-tableaux qui contiennent 
            //la liste des produis pour chaque categorie selectionné
            $listsProducts = $productRepository->findAllBycheckbox($searchCategories);

            $items = [];

            //Je fais une double boucle pour recuperer tous les produits des sous-tableaux et je les stoke
            //dans un nouveau tableau ($results)
            foreach ($listsProducts as $listProducts) {
                foreach ($listProducts as $product) {
                    $items[] = $product;
                }
            }
            //Si le bouton des checkbox est utilisé sans avoir selectionné au moins une categorie, je renvoie un tableau vide    
        } else {
            $items = [];
            $searchCategories = [];
        }


        $resultsNb = count($items);
        $allProducts = $productRepository->findAll();
        $allProductsNb = count($allProducts);

        $results = $paginator->paginate(
            $items,
            $request->query->getInt('page', 1),
            16
        );


     
        if (isset($_GET['q'])) {
            return $this->render('front/shop/index.html.twig', [
                'products' =>  $results,
                'foundProducts' => $resultsNb,
                'searchTerm' => $searchTerm,
                'totalProducts' => $allProductsNb
            ]);
        } else {
            return $this->render('front/shop/index.html.twig', [
                'products' =>  $results,
                'foundProducts' => $resultsNb,
                'totalProducts' => $allProductsNb,
                'searchCategories' => $searchCategories,

            ]);
        }
    }
}
