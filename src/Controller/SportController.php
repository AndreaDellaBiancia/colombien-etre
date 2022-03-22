<?php

namespace App\Controller;

use App\Entity\Sport;
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
            'pageTitle' => 'Sport',
            'postPath' => 'sport_read'
            
        ]);
    }

     /**
     * @Route("/sport{id}", name="sport_read")
     */
    public function read(Sport $sport): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $sport,
            'pageTitle' => 'Sport',
            'categoryPath' => 'sport'
        ]);
    }
}
