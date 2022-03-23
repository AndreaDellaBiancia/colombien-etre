<?php

namespace App\Controller;

use App\Entity\Feed;
use App\Repository\FeedRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedController extends AbstractController
{
    /**
     * @Route("/alimentation", name="feed")
     */
    public function index(FeedRepository $feed): Response
    {
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $feed->findAll(),
            'pageTitle' => 'Alimentation',
            'postPath' => 'feed_read'

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
            'categoryPath' => 'feed'
        ]);
    }
}
