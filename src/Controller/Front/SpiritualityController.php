<?php

namespace App\Controller\Front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpiritualityController extends AbstractController
{
    /**
     * @Route("/spiritualite/ressources-videos", name="spirit-video")
     */
    public function video(): Response
    {

        return $this->render('front/spirituality/video.html.twig');
    }

     
}
