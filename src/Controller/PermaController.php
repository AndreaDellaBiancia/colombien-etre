<?php

namespace App\Controller;

use App\Entity\Perma;
use App\Repository\PermaRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PermaController extends AbstractController
{
    /**
     * @Route("/permatherapie", name="perma")
     */
    public function index(PermaRepository $perma): Response
    {
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $perma->findAll(),
            'pageTitle' => 'Permathérapie',
            'postPath' => 'perma_read'
            
        ]);
    }

     /**
     * @Route("/permatherapie{id}", name="perma_read")
     */
    public function read(Perma $perma, Slugger $slugger, EntityManagerInterface $manager): Response
    {

        if ($perma->getSlug() === null) {
            $slugger->slugifyPost($perma);
            $manager->flush();
        }


        return $this->redirectToRoute('perma_read_slug', [
            'slug' => $perma->getSlug(),
        ]);
    }

    /**
     * @Route("/permatherapie/{slug}", name="perma_read_slug")
     *
     * @return Response
     */
    public function readSlug(Perma $perma): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $perma,
            'pageTitle' => 'Permathérapie',
            'categoryPath' => 'perma'
        ]);
    }
}
