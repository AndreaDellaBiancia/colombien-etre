<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhytoController extends AbstractController
{
    /**
     * @Route("/phytotherapie", name="phyto")
     */
    public function index(): Response
    {
        return $this->render('front/phyto/index.html.twig', [
            'controller_name' => 'PhytoController',
        ]);
    }
}
