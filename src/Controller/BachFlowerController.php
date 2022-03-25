<?php

namespace App\Controller;

use App\Entity\BachFlower;
use App\Repository\BachFlowerRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BachFlowerController extends AbstractController
{
    /**
     * @Route("/fleurs-de-bach", name="bachFlower")
     */
    public function index(BachFlowerRepository $bachFlower, Request $request, PaginatorInterface $paginator): Response
    {

        $allPosts = $bachFlower->findAll();

        $posts = $paginator->paginate(
            $allPosts,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $posts,
            'pageTitle' => 'Fleurs de Bach'
        ]);
    }

     /**
     * @Route("/fleurs-de-bach{id}", name="bachFlower_read")
     */
    public function read(BachFlower $bachFlower, Slugger $slugger, EntityManagerInterface $manager): Response
    {

        if ($bachFlower->getSlug() === null) {
            $slugger->slugifyPost($bachFlower);
        }

        $bachFlower = $bachFlower->setViews($bachFlower->getViews() + 1);
        
        $manager->persist($bachFlower);
        $manager->flush();
       
        return $this->redirectToRoute('bachFlower_read_slug', [
            'slug' => $bachFlower->getSlug(),
        ]);
    }

    /**
     * @Route("/fleurs-de-bach/{slug}", name="bachFlower_read_slug")
     *
     * @return Response
     */
    public function readSlug(bachFlower $bachFlower): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $bachFlower,
            'pageTitle' => 'Fleurs de Bach',
        ]);
    }
}
