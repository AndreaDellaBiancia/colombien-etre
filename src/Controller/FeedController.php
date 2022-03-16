<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedController extends AbstractController
{
    /**
     * @Route("/alimentation", name="feed")
     */
    public function index(): Response
    {
        return $this->render('front/feed/index.html.twig', [
            'controller_name' => 'FeedController',
        ]);
    }
}
