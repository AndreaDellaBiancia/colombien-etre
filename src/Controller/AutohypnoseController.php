<?php

namespace App\Controller;

use App\Entity\Autohypnose;
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
            'pageTitle' => 'Autohypnose',
            'postPath' => 'autohypnose_read'
            
        ]);
    }

     /**
     * @Route("/autohypnose{id}", name="autohypnose_read")
     */
    public function read(Autohypnose $autohypnose): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $autohypnose,
            'pageTitle' => 'Autohypnose',
            'categoryPath' => 'autohypnose'
        ]);
    }
}
