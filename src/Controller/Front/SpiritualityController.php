<?php

namespace App\Controller\Front;

use App\Repository\OracleRepository;
use App\Repository\ReadingSpiritualityRepository;
use App\Repository\VideoSpiritualityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;


class SpiritualityController extends AbstractController
{
    /**
     * @Route("/spiritualite/ressources-videos", name="spirit-video")
     */
    public function video(VideoSpiritualityRepository $videoSpirituality, Request $request, PaginatorInterface $paginator): Response
    {
        $allVideos = $videoSpirituality->findBy([], ['id' => 'DESC']);
        $videos = $paginator->paginate(
            $allVideos,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('front/spirituality/video.html.twig', [
            'videos' => $videos
        ]);
    }

     /**
     * @Route("/spiritualite/idées-de-lecture", name="spirit-readings")
     */
    public function readings(ReadingSpiritualityRepository $readingSpirituality,  Request $request, PaginatorInterface $paginator): Response
    {

        $allReadings = $readingSpirituality->findBy([], ['id' => 'DESC']);
        $readings = $paginator->paginate(
            $allReadings,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('front/spirituality/reading.html.twig', [
            'readings' => $readings
        ]);
    }

     /**
     * @Route("/spiritualite/oracles", name="oracles")
     */
    public function oracles(OracleRepository $oracles,  Request $request, PaginatorInterface $paginator): Response
    {
        $allOracles = $oracles->findBy([], ['id' => 'DESC']);
        $oracles = $paginator->paginate(
            $allOracles,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('front/spirituality/oracle.html.twig', [
            'oracles' => $oracles
        ]);
    }

     
}
