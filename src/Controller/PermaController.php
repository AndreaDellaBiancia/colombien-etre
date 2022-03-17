<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PermaController extends AbstractController
{
    /**
     * @Route("/permatherapie", name="perma")
     */
    public function index(): Response
    {
        return $this->render('front/perma/index.html.twig', [
            'controller_name' => 'PermaController',
        ]);
    }
}
