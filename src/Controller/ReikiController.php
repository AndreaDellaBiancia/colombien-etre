<?php

namespace App\Controller;

use App\Repository\ReikiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReikiController extends AbstractController
{
    /**
     * @Route("/reiki", name="reiki")
     */
    public function index(ReikiRepository $reiki): Response
    {
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $reiki->findAll(),
            'pageTitle' => 'Reiki' 
        ]);
    }
}
