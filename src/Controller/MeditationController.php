<?php

namespace App\Controller;

use App\Repository\MeditationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeditationController extends AbstractController
{
    /**
     * @Route("/meditation", name="meditation")
     */
    public function index(MeditationRepository $meditation): Response
    {
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $meditation->findAll(),
            'pageTitle' => 'Méditation'
        ]);
    }
}
