<?php

namespace App\Controller\Front;

use App\Entity\Massage;
use App\Repository\MassageRepository;
use App\Service\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MassageController extends AbstractController
{
    /**
     * @Route("/massages", name="massage")
     */
    public function index(MassageRepository $massage, Request $request, PaginatorInterface $paginator): Response
    {

        $allPosts = $massage->findAll();

        $posts = $paginator->paginate(
            $allPosts,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('front/corpsEsprit/posts_list.html.twig', [
            'posts' => $posts,
            'pageTitle' => 'Massages'
        ]);
    }

    /**
     * @Route("/massages{id}", name="massage_read")
     */
    public function read(Massage $massage, Slugger $slugger, EntityManagerInterface $manager): Response
    {

        if ($massage->getSlug() === null) {
            $slugger->slugifyPost($massage);
        }

        $massage = $massage->setViews($massage->getViews() + 1);
        
        $manager->persist($massage);
        $manager->flush();



        return $this->redirectToRoute('massage_read_slug', [
            'slug' => $massage->getSlug(),
        ]);
    }

    /**
     * @Route("/massages/{slug}", name="massage_read_slug")
     *
     * @return Response
     */
    public function readSlug(Massage $massage): Response
    {
        return $this->render('front/corpsEsprit/post.html.twig', [
            'post' => $massage,
            'pageTitle' => 'Massages'
        ]);
    }
}
