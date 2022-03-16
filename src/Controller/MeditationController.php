<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeditationController extends AbstractController
{
    /**
     * @Route("/meditation", name="app_meditation")
     */
    public function index(): Response
    {
        return $this->render('meditation/index.html.twig', [
            'controller_name' => 'MeditationController',
        ]);
    }
}
