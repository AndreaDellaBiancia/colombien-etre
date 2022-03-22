<?php

namespace App\Controller;

use App\Entity\Feed;
use App\Repository\FeedRepository;
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
    public function read(Feed $feed): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $feed,
            'pageTitle' => 'Alimentation',
            'categoryPath' => 'feed'
        ]);
    }
}
