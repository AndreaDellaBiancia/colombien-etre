<?php

namespace App\Controller;

use App\Repository\BachFlowerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BachFlowerController extends AbstractController
{
    /**
     * @Route("/fleurs-de-bach", name="bachFlower")
     */
    public function index(BachFlowerRepository $bachFlower): Response
    {
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $bachFlower->findAll(),
            'pageTitle' => 'Fleurs de Bach'
        ]);
    }
}
