<?php

namespace App\Controller;

use App\Entity\Phyto;
use App\Repository\PhytoRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhytoController extends AbstractController
{
    /**
     * @Route("/phytotherapie", name="phyto")
     */
    public function index(PhytoRepository $phyto): Response
    {
        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $phyto->findAll(),
            'pageTitle' => 'Phytothérapie',
        ]);
    }

     /**
     * @Route("/phytotherapie{id}", name="phyto_read")
     */
    public function read(Phyto $phyto, Slugger $slugger, EntityManagerInterface $manager): Response
    {

        if ($phyto->getSlug() === null) {
            $slugger->slugifyPost($phyto);
        }

        $phyto = $phyto->setViews($phyto->getViews() + 1);
        
        $manager->persist($phyto);
        $manager->flush();


        return $this->redirectToRoute('phyto_read_slug', [
            'slug' => $phyto->getSlug(),
        ]);
    }

    /**
     * @Route("/phytotherapie/{slug}", name="phyto_read_slug")
     *
     * @return Response
     */
    public function readSlug(Phyto $phyto): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $phyto,
            'pageTitle' => 'Phytothérapie',
        ]);
    }
}
