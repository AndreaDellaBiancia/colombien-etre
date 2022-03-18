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
     * @Route("/boutique/search", name="searchProduct")
     */
    public function index(ProductRepository $productRepository): Response
    {

        if (isset($_GET['q'])) {
            $searchTerm = $_GET['q'];
            $results = $productRepository->findAllBySearchTerm($searchTerm);
        } elseif (isset($_POST['category']) and !empty($_POST['category'])) {
            $searchTerms = $_POST['category'];

            //Je recupere un tableau multidimensionnel avec des sous-tableaux qui contiennent 
            //la liste des produis pour chaque categorie selectionné
            $listsProducts = $productRepository->findAllBycheckbox($searchTerms);

            $results = [];

            //Je fais une double boucle pour recuperer tous les produits des sous-tableaux et je les stoke
            //dans un nouveau tableau ($results)
            foreach ($listsProducts as $listProducts) {
                foreach ($listProducts as $product) {
                    $results[] = $product;
                }
            }
            //Si le bouton des checkbox est utilisé sans avoir selectionné au moins une categorie, je renvoie un tableau vide    
        } else {
            $results = [];
        }


        $resultsNb = count($results);
        $allProducts = $productRepository->findAll();
        $allProductsNb = count($allProducts);

        //Si get recupere "q" (input rechercher) je peux returner le searchTerm sinon je ne le retourne pas
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
                'totalProducts' => $allProductsNb
            ]);
        }
    }
}
