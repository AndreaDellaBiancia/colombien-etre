<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BachFlowerController extends AbstractController
{
    /**
     * @Route("/fleurs-de-bach", name="bachFlower")
     */
    public function index(): Response
    {
        return $this->render('front/bachFlower/index.html.twig', [
            'controller_name' => 'BachFlowerController',
        ]);
    }
}
