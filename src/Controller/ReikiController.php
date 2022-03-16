<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReikiController extends AbstractController
{
    /**
     * @Route("/reiki", name="reiki")
     */
    public function index(): Response
    {
        return $this->render('front/reiki/index.html.twig', [
            'controller_name' => 'ReikiController',
        ]);
    }
}
