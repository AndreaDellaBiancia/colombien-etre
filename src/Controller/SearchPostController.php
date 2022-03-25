<?php

namespace App\Controller;

use App\Repository\AutohypnoseRepository;
use App\Repository\BachFlowerRepository;
use App\Repository\FeedRepository;
use App\Repository\MassageRepository;
use App\Repository\MeditationRepository;
use App\Repository\PermaRepository;
use App\Repository\PhytoRepository;
use App\Repository\ReikiRepository;
use App\Repository\SportRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchPostController extends AbstractController
{
    private $autohypnose;
    private $bachFlower;
    private $feed;
    private $massage;
    private $meditation;
    private $perma;
    private $phyto;
    private $reiki;
    private $sport;

    public function __construct(
        AutohypnoseRepository $autohypnose,
        BachFlowerRepository $bachFlower,
        FeedRepository $feed,
        MassageRepository $massage,
        MeditationRepository $meditation,
        PermaRepository $perma,
        PhytoRepository $phyto,
        ReikiRepository $reiki,
        SportRepository $sport
    ) {
        $this->autohypnose = $autohypnose;
        $this->bachFlower = $bachFlower;
        $this->feed = $feed;
        $this->massage = $massage;
        $this->meditation = $meditation;
        $this->perma = $perma;
        $this->phyto = $phyto;
        $this->reiki = $reiki;
        $this->sport = $sport;
    }


    /**
     * @Route("/corps-esprit/search", name="searchPost")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        $posts = [];

        if (isset($_GET['q'])) {
            $searchTerm = $_GET['q'];
            $postsLists[] = $this->autohypnose->findAllBySearchTerm($searchTerm);
            $postsLists[] = $this->bachFlower->findAllBySearchTerm($searchTerm);
            $postsLists[] = $this->feed->findAllBySearchTerm($searchTerm);
            $postsLists[] = $this->massage->findAllBySearchTerm($searchTerm);
            $postsLists[] = $this->meditation->findAllBySearchTerm($searchTerm);
            $postsLists[] = $this->perma->findAllBySearchTerm($searchTerm);
            $postsLists[] = $this->phyto->findAllBySearchTerm($searchTerm);
            $postsLists[] = $this->reiki->findAllBySearchTerm($searchTerm);
            $postsLists[] = $this->sport->findAllBySearchTerm($searchTerm);

            //Je fais une double boucle pour recuperer tous les posts des sous-tableaux et je les stoke
            //dans un nouveau tableau ($items)
            foreach ($postsLists as $postList) {
                foreach ($postList as $post) {
                    $posts[] = $post;
                }
            }
        }


        $foundPosts = count($posts);

        $posts = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1),
            10
        );


        if (isset($_GET['q'])) {
            return $this->render('front/corpsEsprit/list_found_posts.html.twig', [
                'posts' =>  $posts,
                'foundPosts' => $foundPosts,
                'searchTerm' => $searchTerm,
            ]);
        } else {
            return $this->render('front/corpsEsprit/corpsEsprit.html.twig');
        };
    }
}
