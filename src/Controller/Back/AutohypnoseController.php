<?php

namespace App\Controller\Back;

use App\Entity\Autohypnose;
use App\Repository\AutohypnoseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

  /**
     * @Route("/backoffice/autohypnose", name="back_autohypnose_")
     */
class AutohypnoseController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(AutohypnoseRepository $autohypnoseRepository): Response
    {
        return $this->render('back/corpsEsprit/index.html.twig', [
            'posts' => $autohypnoseRepository->findAll()
        ]);
    }

     /**
     * @Route("/{id}", name="read")
     */
    public function read(Autohypnose $autohypnose): Response
    {
        return $this->render('back/corpsEsprit/read.html.twig', [
            'post' => $autohypnose
        ]);
    }
}
