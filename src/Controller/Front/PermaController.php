<?php

namespace App\Controller\Front;

use App\Entity\Perma;
use App\Repository\PermaRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PermaController extends AbstractController
{
    /**
     * @Route("/permatherapie", name="perma")
     */
    public function index(PermaRepository $perma, Request $request, PaginatorInterface $paginator): Response
    {

        $allPosts = $perma->findBy([], ['id' => 'DESC']);

        $posts = $paginator->paginate(
            $allPosts,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $posts,
            'pageTitle' => 'Permathérapie'
        ]);
    }

     /**
     * @Route("/permatherapie{id}", name="perma_read")
     */
    public function read(Perma $perma, Slugger $slugger, EntityManagerInterface $manager): Response
    {

        if ($perma->getSlug() === null) {
            $slugger->slugifyPost($perma);
        }

        $perma = $perma->setViews($perma->getViews() + 1);
        
        $manager->persist($perma);
        $manager->flush();


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
            'pageTitle' => 'Permathérapie'
        ]);
    }
}
