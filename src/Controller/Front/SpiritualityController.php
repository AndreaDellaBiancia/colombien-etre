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
    private $paginator;

    public function __construct(PaginatorInterface $paginatorInterface)
    {
        $this->paginator = $paginatorInterface;
    }

    /**
     * @Route("/spiritualite/ressources-videos", name="spirit-video")
     */
    public function video(VideoSpiritualityRepository $videoSpirituality, Request $request): Response
    {
        $allVideos = $videoSpirituality->findBy([], ['id' => 'DESC']);

        $videos = $this->paginator->paginate(
            $allVideos,
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('front/spirituality/video.html.twig', [
            'videos' => $videos
        ]);
    }

    /**
     * @Route("/spiritualite/idées-de-lecture", name="spirit-readings")
     */
    public function readings(ReadingSpiritualityRepository $readingSpirituality, Request $request): Response
    {

        $allReadings = $readingSpirituality->findBy([], ['id' => 'DESC']);

        $readings = $this->paginator->paginate(
            $allReadings,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('front/spirituality/reading.html.twig', [
            'readings' => $readings
        ]);
    }

    /**
     * @Route("/spiritualite/oracles", name="oracles")
     */
    public function oracles(OracleRepository $oraclesSpirituality, Request $request): Response
    {

        $allOracles = $oraclesSpirituality->findBy([], ['id' => 'DESC']);

        $oracles = $this->paginator->paginate(
            $allOracles,
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('front/spirituality/oracle.html.twig', [
            'oracles' => $oracles
        ]);
    }
}
