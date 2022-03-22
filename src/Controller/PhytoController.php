<?php

namespace App\Controller;

use App\Entity\Phyto;
use App\Repository\PhytoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhytoController extends AbstractController
{
    /**
     * @Route("/phytotherapie", name="phyto")
     */
    public function index(PhytoRepository $phyto): Response
    {
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $phyto->findAll(),
            'pageTitle' => 'Phytothérapie',
            'postPath' => 'phyto_read' 
        ]);
    }

     /**
     * @Route("/phytotherapie{id}", name="phyto_read")
     */
    public function read(Phyto $phyto): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $phyto,
            'pageTitle' => 'Phytothérapie',
            'categoryPath' => 'phyto'
        ]);
    }
}
