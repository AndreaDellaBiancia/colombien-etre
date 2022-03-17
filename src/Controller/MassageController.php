<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MassageController extends AbstractController
{
    /**
     * @Route("/massages", name="massage")
     */
    public function index(): Response
    {
        return $this->render('front/massage/index.html.twig', [
            'controller_name' => 'MassageController',
        ]);
    }
}
