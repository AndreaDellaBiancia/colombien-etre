<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("", name="home")
     */
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }

    /**
    * @Route("/corps-esprit", name="corpsEsprit")
    */
    public function corpsEsprit(): Response
    {
        return $this->render('main/corpsEsprit.html.twig');
    }

    /**
    * @Route("/qui-suis-je", name="quiSuisJe")
    */
    public function quiSuisJe(): Response
    {
        return $this->render('main/quiSuisJe.html.twig');
    }
}
