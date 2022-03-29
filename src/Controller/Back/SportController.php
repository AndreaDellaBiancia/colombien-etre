<?php

namespace App\Controller\Back;

use App\Entity\Sport;
use App\Form\PostType;
use App\Repository\SportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * 
 * @Route("/backoffice/sport", name="back_sport_")
 */
class SportController extends AbstractController
{

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("", name="browse")
     */
    public function browse(SportRepository $sportRepository): Response
    {
        return $this->render('back/corpsEsprit/browse.html.twig', [
            'posts' => $sportRepository->findBy([], ['id' => 'DESC']),
            'category' => 'sport',
            'pageTitle' => 'Sport' 
        ]);
    }

    /**
     * @Route("/{id}", name="read")
     */
    public function read(Sport $sport): Response
    {
        return $this->render('back/corpsEsprit/read.html.twig', [
            'post' => $sport
        ]);
    }

    /**
     * 
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request, Sport $sport): Response
    {
        $form = $this->createForm(PostType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $sport->setUpdatedAt(new \DateTimeImmutable());
            $sport->setSlug(null);
            $this->manager->flush();

            return $this->redirectToRoute('back_sport_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/edit.html.twig', [
            'post' => $sport,
            'form' => $form,
        ]);
    }

    /**
     * 
     * @Route("/add/post", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sport = new Sport();
        $form = $this->createForm(PostType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($sport);
            $entityManager->flush();

            return $this->redirectToRoute('back_sport_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/add.html.twig', [
            'post' => $sport,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Sport $sport)
    {
        $this->manager->remove($sport);
        $this->manager->flush();

        return $this->redirectToRoute('back_sport_browse');
    }
}
