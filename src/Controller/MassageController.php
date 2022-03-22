<?php

namespace App\Controller;

use App\Repository\MassageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MassageController extends AbstractController
{
    /**
     * @Route("/massages", name="massage")
     */
    public function index(MassageRepository $massage): Response
    {
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $massage->findAll(),
            'pageTitle' => 'Massages'
        ]);
    }
}
