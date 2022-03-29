<?php

namespace App\Controller\Back;

use App\Entity\Meditation;
use App\Form\PostType;
use App\Repository\MeditationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * 
 * @Route("/backoffice/meditation", name="back_meditation_")
 */
class MeditationController extends AbstractController
{

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("", name="browse")
     */
    public function browse(MeditationRepository $meditationRepository): Response
    {
        return $this->render('back/corpsEsprit/browse.html.twig', [
            'posts' => $meditationRepository->findBy([], ['id' => 'DESC']),
            'category' => 'meditation',
            'pageTitle' => 'Méditation' 
        ]);
    }

    /**
     * @Route("/{id}", name="read")
     */
    public function read(Meditation $meditation): Response
    {
        return $this->render('back/corpsEsprit/read.html.twig', [
            'post' => $meditation
        ]);
    }

    /**
     * 
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request,  Meditation $meditation): Response
    {
        $form = $this->createForm(PostType::class, $meditation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $meditation->setUpdatedAt(new \DateTimeImmutable());
            $meditation->setSlug(null);
            $this->manager->flush();

            return $this->redirectToRoute('back_meditation_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/edit.html.twig', [
            'post' => $meditation,
            'form' => $form,
        ]);
    }

    /**
     * 
     * @Route("/add/post", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $meditation = new Meditation();
        $form = $this->createForm(PostType::class, $meditation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($meditation);
            $entityManager->flush();

            return $this->redirectToRoute('back_meditation_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/add.html.twig', [
            'post' => $meditation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Meditation $meditation)
    {
        $this->manager->remove($meditation);
        $this->manager->flush();

        return $this->redirectToRoute('back_meditation_browse');
    }
}
