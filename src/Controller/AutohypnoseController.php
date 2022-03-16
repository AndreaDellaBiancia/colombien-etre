<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AutohypnoseController extends AbstractController
{
    /**
     * @Route("/autohypnose", name="app_autohypnose")
     */
    public function index(): Response
    {
        return $this->render('autohypnose/index.html.twig', [
            'controller_name' => 'AutohypnoseController',
        ]);
    }
}
