<?php

namespace App\Controller;

use App\Entity\Meditation;
use App\Repository\MeditationRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeditationController extends AbstractController
{
    /**
     * @Route("/meditation", name="meditation")
     */
    public function index(MeditationRepository $meditation): Response
    {
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $meditation->findAll(),
            'pageTitle' => 'Méditation',
            'postPath' => 'meditation_read'
            
        ]);
    }

     /**
     * @Route("/meditation{id}", name="meditation_read")
     */
    public function read(Meditation $meditation, Slugger $slugger, EntityManagerInterface $manager): Response
    {

        if ($meditation->getSlug() === null) {
            $slugger->slugifyPost($meditation);
            $manager->flush();
        }


        return $this->redirectToRoute('meditation_read_slug', [
            'slug' => $meditation->getSlug(),
        ]);
    }

    /**
     * @Route("/meditation/{slug}", name="meditation_read_slug")
     *
     * @return Response
     */
    public function readSlug(Meditation $meditation): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $meditation,
            'pageTitle' => 'Mediatation',
            'categoryPath' => 'meditation'
        ]);
    }
}
