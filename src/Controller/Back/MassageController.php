<?php

namespace App\Controller\Back;

use App\Entity\Massage;
use App\Form\PostType;
use App\Repository\MassageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * 
 * @Route("/backoffice/massage", name="back_massage_")
 */
class MassageController extends AbstractController
{

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("", name="browse")
     */
    public function browse(MassageRepository $massageRepository): Response
    {
        return $this->render('back/corpsEsprit/browse.html.twig', [
            'posts' => $massageRepository->findBy([], ['id' => 'DESC']),
            'category' => 'massage',
            'pageTitle' => 'Massage' 
        ]);
    }

    /**
     * @Route("/{id}", name="read")
     */
    public function read(Massage $massage): Response
    {
        return $this->render('back/corpsEsprit/read.html.twig', [
            'post' => $massage
        ]);
    }

    /**
     * 
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request,  Massage $massage): Response
    {
        $form = $this->createForm(PostType::class, $massage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $massage->setUpdatedAt(new \DateTimeImmutable());
            $massage->setSlug(null);
            $this->manager->flush();

            return $this->redirectToRoute('back_massage_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/edit.html.twig', [
            'post' => $massage,
            'form' => $form,
        ]);
    }

    /**
     * 
     * @Route("/add/post", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $massage = new Massage();
        $form = $this->createForm(PostType::class, $massage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($massage);
            $entityManager->flush();

            return $this->redirectToRoute('back_massage_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/add.html.twig', [
            'post' => $massage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Massage $massage)
    {
        $this->manager->remove($massage);
        $this->manager->flush();

        return $this->redirectToRoute('back_massage_browse');
    }
}
