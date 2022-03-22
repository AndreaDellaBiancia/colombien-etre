<?php

namespace App\Controller;

use App\Entity\BachFlower;
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
            'pageTitle' => 'Fleurs de Bach',
            'postPath' => 'backFlower_read'
            
        ]);
    }

     /**
     * @Route("/fleurs-de-bach{id}", name="backFlower_read")
     */
    public function read(BachFlower $bachFlower): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $bachFlower,
            'pageTitle' => 'Fleurs de Bach',
            'categoryPath' => 'bachFlower'
        ]);
    }
}
