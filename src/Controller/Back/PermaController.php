<?php

namespace App\Controller\Back;

use App\Entity\Perma;
use App\Form\PostType;
use App\Repository\PermaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * 
 * @Route("/backoffice/permatherapie", name="back_perma_")
 */
class PermaController extends AbstractController
{

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("", name="browse")
     */
    public function browse(PermaRepository $permaRepository): Response
    {
        return $this->render('back/corpsEsprit/browse.html.twig', [
            'posts' => $permaRepository->findBy([], ['id' => 'DESC']),
            'category' => 'perma',
            'pageTitle' => 'Permatérapie' 
        ]);
    }

    /**
     * @Route("/{id}", name="read")
     */
    public function read(Perma $perma): Response
    {
        return $this->render('back/corpsEsprit/read.html.twig', [
            'post' => $perma
        ]);
    }

    /**
     * 
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request,  Perma $perma): Response
    {
        $form = $this->createForm(PostType::class, $perma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $perma->setUpdatedAt(new \DateTimeImmutable());
            $perma->setSlug(null);
            $this->manager->flush();

            return $this->redirectToRoute('back_perma_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/edit.html.twig', [
            'post' => $perma,
            'form' => $form,
        ]);
    }

    /**
     * 
     * @Route("/add/post", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $perma = new Perma();
        $form = $this->createForm(PostType::class, $perma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($perma);
            $entityManager->flush();

            return $this->redirectToRoute('back_perma_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/add.html.twig', [
            'post' => $perma,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Perma $perma)
    {
        $this->manager->remove($perma);
        $this->manager->flush();

        return $this->redirectToRoute('back_perma_browse');
    }
}
