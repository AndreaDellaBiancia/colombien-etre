<?php

namespace App\Controller;

use App\Entity\Feed;
use App\Repository\FeedRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedController extends AbstractController
{
    /**
     * @Route("/alimentation", name="feed")
     */
    public function index(FeedRepository $feed, Request $request, PaginatorInterface $paginator): Response
    {

        $allPosts = $feed->findAll();

        $posts = $paginator->paginate(
            $allPosts,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $posts,
            'pageTitle' => 'Alimentation'
        ]);
    }

    /**
     * @Route("/alimentation{id}", name="feed_read")
     */
    public function read(Feed $feed, Slugger $slugger, EntityManagerInterface $manager): Response
    {

        if ($feed->getSlug() === null) {
            $slugger->slugifyPost($feed);
        }

        $feed = $feed->setViews($feed->getViews() + 1);
        
        $manager->persist($feed);
        $manager->flush();

        return $this->redirectToRoute('feed_read_slug', [
            'slug' => $feed->getSlug(),
        ]);
    }

    /**
     * @Route("/alimentation/{slug}", name="feed_read_slug")
     *
     * @return Response
     */
    public function readSlug(Feed $feed): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $feed,
            'pageTitle' => 'Alimentation',
        ]);
    }
}
