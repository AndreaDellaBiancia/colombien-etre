<?php

namespace App\Controller;

use App\Entity\Autohypnose;
use App\Repository\AutohypnoseRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AutohypnoseController extends AbstractController
{
    /**
     * @Route("/autohypnose", name="autohypnose")
     */
    public function index(AutohypnoseRepository $autohypnose): Response
    {
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $autohypnose->findAll(),
            'pageTitle' => 'Autohypnose',
            'postPath' => 'autohypnose_read'

        ]);
    }
    
     /**
     * 
     * @Route("/autohypnose{id}", name="autohypnose_read", requirements={"id"="\d+"})
     * @return Response
     */
    public function read(Autohypnose $autohypnose, Slugger $slugger, EntityManagerInterface $manager): Response
    {

        if ($autohypnose->getSlug() === null) {
            $slugger->slugifyPost($autohypnose);
        }

        $autohypnose = $autohypnose->setViews($autohypnose->getViews() + 1);
        
        $manager->persist($autohypnose);
        $manager->flush();

        return $this->redirectToRoute('autohypnose_read_slug', [
            'slug' => $autohypnose->getSlug(),
        ]);
    }

    /**
     * @Route("/autohypnose/{slug}", name="autohypnose_read_slug")
     *
     * @return Response
     */
    public function readSlug(Autohypnose $autohypnose): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $autohypnose,
            'pageTitle' => 'Autohypnose',
            'categoryPath' => 'autohypnose'
        ]);
    }
}
