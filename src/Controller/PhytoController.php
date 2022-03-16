<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhytoController extends AbstractController
{
    /**
     * @Route("/phyto", name="app_phyto")
     */
    public function index(): Response
    {
        return $this->render('phyto/index.html.twig', [
            'controller_name' => 'PhytoController',
        ]);
    }
}
