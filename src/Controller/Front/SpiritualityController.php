<?php

namespace App\Controller\Front;

use App\Entity\VideoSpirituality;
use App\Repository\VideoSpiritualityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpiritualityController extends AbstractController
{
    /**
     * @Route("/spiritualite/ressources-videos", name="spirit-video")
     */
    public function video(VideoSpiritualityRepository $videoSpirituality): Response
    {

        return $this->render('front/spirituality/video.html.twig', [
            'videos' => $videoSpirituality->findBy([], ['id' => 'DESC'])
        ]);
    }

     
}
