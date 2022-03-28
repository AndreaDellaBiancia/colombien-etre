<?php

namespace App\Controller\Front;

use App\Entity\Meditation;
use App\Repository\MeditationRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeditationController extends AbstractController
{
    /**
     * @Route("/meditation", name="meditation")
     */
    public function index(MeditationRepository $meditation, Request $request, PaginatorInterface $paginator): Response
    {

        $allPosts = $meditation->findAll();

        $posts = $paginator->paginate(
            $allPosts,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $posts,
            'pageTitle' => 'Méditation'
        ]);
    }

     /**
     * @Route("/meditation{id}", name="meditation_read")
     */
    public function read(Meditation $meditation, Slugger $slugger, EntityManagerInterface $manager): Response
    {

        if ($meditation->getSlug() === null) {
            $slugger->slugifyPost($meditation);
        }

        $meditation = $meditation->setViews($meditation->getViews() + 1);
        
        $manager->persist($meditation);
        $manager->flush();


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
        ]);
    }
}
