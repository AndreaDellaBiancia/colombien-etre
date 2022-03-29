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
 * 
 * @Route("/backoffice/autohypnose", name="back_autohypnose_")
 */
class AutohypnoseController extends AbstractController
{

    private $manager;


    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("", name="browse")
     */
    public function browse(AutohypnoseRepository $autohypnoseRepository): Response
    {
        return $this->render('back/corpsEsprit/browse.html.twig', [
            'posts' => $autohypnoseRepository->findBy([], ['id' => 'DESC']),
            'category' => 'autohypnose',
            'pageTitle' => 'Autohypnose'
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
    public function edit(Request $request,  Autohypnose $autohypnose): Response
    {
        $form = $this->createForm(PostType::class, $autohypnose);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $autohypnose->setUpdatedAt(new \DateTimeImmutable());
            $autohypnose->setSlug(null);
            $this->manager->flush();

            return $this->redirectToRoute('back_autohypnose_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/edit.html.twig', [
            'post' => $autohypnose,
            'form' => $form,
        ]);
    }

    /**
     * 
     * @Route("/add/post", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $autohypnose = new Autohypnose();
        $form = $this->createForm(PostType::class, $autohypnose);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($autohypnose);
            $entityManager->flush();

            return $this->redirectToRoute('back_autohypnose_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/add.html.twig', [
            'post' => $autohypnose,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Autohypnose $autohypnose)
    {
        $this->manager->remove($autohypnose);
        $this->manager->flush();

        return $this->redirectToRoute('back_autohypnose_browse');
    }
}
