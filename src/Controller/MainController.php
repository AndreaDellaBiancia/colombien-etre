<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("", name="home")
     */
    public function home(ProductRepository $productRepository): Response
    {

        return $this->render('front/main/home.html.twig', [
            'products' => $productRepository->findBy([], ['id' => 'DESC'], 3)
        ]);
    }

    /**
    * @Route("/corps-esprit", name="corpsEsprit")
    */
    public function corpsEsprit(): Response
    {
        return $this->render('front/corpsEsprit/corpsEsprit.html.twig');
    }

    /**
    * @Route("/qui-suis-je", name="quiSuisJe")
    */
    public function quiSuisJe(): Response
    {
        return $this->render('front/main/quiSuisJe.html.twig');
    }
}
