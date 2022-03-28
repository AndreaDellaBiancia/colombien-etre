<?php

namespace App\Controller\Back;

use App\Entity\Autohypnose;
use App\Form\PostType;
use App\Repository\AutohypnoseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

  /**
     * @Route("/backoffice/autohypnose", name="back_autohypnose_")
     */
class AutohypnoseController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(AutohypnoseRepository $autohypnoseRepository): Response
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

    /**
     * 
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request,  Autohypnose $autohypnose, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class, $autohypnose);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $autohypnose->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            return $this->redirectToRoute('back_autohypnose_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/edit.html.twig', [
            'post' => $autohypnose,
            'form' => $form,
        ]);
    }
}
