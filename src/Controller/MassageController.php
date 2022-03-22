<?php

namespace App\Controller;

use App\Entity\Massage;
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
            'pageTitle' => 'Massages',
            'postPath' => 'massage_read'
            
        ]);
    }

     /**
     * @Route("/massages{id}", name="massage_read")
     */
    public function read(Massage $massage): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $massage,
            'pageTitle' => 'Massages',
            'categoryPath' => 'massage',
        ]);
    }
}
