<?php

namespace App\Controller;

use App\Entity\Reiki;
use App\Repository\ReikiRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReikiController extends AbstractController
{
    /**
     * @Route("/reiki", name="reiki")
     */
    public function index(ReikiRepository $reiki, Request $request, PaginatorInterface $paginator): Response
    {
        $allPosts = $reiki->findAll();

        $posts = $paginator->paginate(
            $allPosts,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $posts,
            'pageTitle' => 'Reiki'
        ]);
    }

     /**
     * @Route("/reiki{id}", name="reiki_read")
     */
    public function read(Reiki $reiki, Slugger $slugger, EntityManagerInterface $manager): Response
    {

        if ($reiki->getSlug() === null) {
            $slugger->slugifyPost($reiki);
        }

        $reiki = $reiki->setViews($reiki->getViews() + 1);
        
        $manager->persist($reiki);
        $manager->flush();


        return $this->redirectToRoute('reiki_read_slug', [
            'slug' => $reiki->getSlug(),
        ]);
    }

    /**
     * @Route("/reiki/{slug}", name="reiki_read_slug")
     *
     * @return Response
     */
    public function readSlug(Reiki $reiki): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $reiki,
            'pageTitle' => 'Reiki'
        ]);
    }
}
