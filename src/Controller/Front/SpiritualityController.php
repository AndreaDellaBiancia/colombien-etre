<?php

namespace App\Controller\Front;


use App\Repository\ReadingSpiritualityRepository;
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

     /**
     * @Route("/spiritualite/idées-de-lecture", name="spirit-readings")
     */
    public function readings(ReadingSpiritualityRepository $readingSpirituality): Response
    {

        return $this->render('front/spirituality/reading.html.twig', [
            'readings' => $readingSpirituality->findBy([], ['id' => 'DESC'])
        ]);
    }

     
}
