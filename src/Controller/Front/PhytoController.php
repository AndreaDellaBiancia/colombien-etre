<?php

namespace App\Controller\Front;

use App\Entity\Phyto;
use App\Repository\PhytoRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhytoController extends AbstractController
{
    /**
     * @Route("/phytotherapie", name="phyto")
     */
    public function index(PhytoRepository $phyto, Request $request, PaginatorInterface $paginator): Response
    {

        $allPosts = $phyto->findBy([], ['id' => 'DESC']);

        $posts = $paginator->paginate(
            $allPosts,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $posts,
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
