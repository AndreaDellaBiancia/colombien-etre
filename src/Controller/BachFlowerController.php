<?php

namespace App\Controller;

use App\Entity\BachFlower;
use App\Repository\BachFlowerRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BachFlowerController extends AbstractController
{
    /**
     * @Route("/fleurs-de-bach", name="bachFlower")
     */
    public function index(BachFlowerRepository $bachFlower): Response
    {
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $bachFlower->findAll(),
            'pageTitle' => 'Fleurs de Bach',
            'postPath' => 'bachFlower_read'
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
            'categoryPath' => 'bachFlower'
        ]);
    }
}
