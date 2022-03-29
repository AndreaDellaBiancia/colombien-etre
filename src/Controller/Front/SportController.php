<?php

namespace App\Controller\Front;

use App\Entity\Sport;
use App\Repository\SportRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SportController extends AbstractController
{
    /**
     * @Route("/sport", name="sport")
     */
    public function index(SportRepository $sport, Request $request, PaginatorInterface $paginator): Response
    {
        
        $allPosts = $sport->findBy([], ['id' => 'DESC']);

        $posts = $paginator->paginate(
            $allPosts,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $posts,
            'pageTitle' => 'Sport',
        ]);
    }

     /**
     * @Route("/sport{id}", name="sport_read")
     */
    public function read(Sport $sport, Slugger $slugger, EntityManagerInterface $manager): Response
    {

        if ($sport->getSlug() === null) {
            $slugger->slugifyPost($sport);
        }

        $sport = $sport->setViews($sport->getViews() + 1);
        
        $manager->persist($sport);
        $manager->flush();


        return $this->redirectToRoute('sport_read_slug', [
            'slug' => $sport->getSlug(),
        ]);
    }

    /**
     * @Route("/sport/{slug}", name="sport_read_slug")
     *
     * @return Response
     */
    public function readSlug(Sport $sport): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $sport,
            'pageTitle' => 'Sport'
        ]);
    }
}
