<?php

namespace App\Controller;

use App\Repository\AutohypnoseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AutohypnoseController extends AbstractController
{
    /**
     * @Route("/autohypnose", name="autohypnose")
     */
    public function index(AutohypnoseRepository $autohypnose): Response
    {
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $autohypnose->findAll(),
            'pageTitle' => 'Autohypnose'
        ]);
    }
}
