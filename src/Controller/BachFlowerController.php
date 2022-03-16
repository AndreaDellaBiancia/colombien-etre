<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BachFlowerController extends AbstractController
{
    /**
     * @Route("/bach/flower", name="app_bach_flower")
     */
    public function index(): Response
    {
        return $this->render('bach_flower/index.html.twig', [
            'controller_name' => 'BachFlowerController',
        ]);
    }
}
