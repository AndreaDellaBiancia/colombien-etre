<?php

namespace App\Controller;

use App\Repository\SportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SportController extends AbstractController
{
    /**
     * @Route("/sport", name="sport")
     */
    public function index(SportRepository $sport): Response
    {
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $sport->findAll(),
            'pageTitle' => 'Sport'
        ]);
    }
}
