<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SportController extends AbstractController
{
    /**
     * @Route("/sport", name="sport")
     */
    public function index(): Response
    {
        return $this->render('front/sport/index.html.twig', [
            'controller_name' => 'SportController',
        ]);
    }
}
