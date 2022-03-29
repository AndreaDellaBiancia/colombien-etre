<?php

namespace App\Controller\Back;

use App\Entity\BachFlower;
use App\Form\PostType;
use App\Repository\BachFlowerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * 
 * @Route("/backoffice/fleurs-de-bach", name="back_bachFlower_")
 */
class BachFlowerController extends AbstractController
{

    private $manager;


    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("", name="browse")
     */
    public function browse(BachFlowerRepository $bachFlowerRepository): Response
    {
        return $this->render('back/corpsEsprit/browse.html.twig', [
            'posts' => $bachFlowerRepository->findBy([], ['id' => 'DESC']),
            'category' => 'bachFlower',
            'pageTitle' => 'Fleurs de Bach' 
        ]);
    }

    /**
     * @Route("/{id}", name="read")
     */
    public function read(BachFlower $bachFlower): Response
    {
        return $this->render('back/corpsEsprit/read.html.twig', [
            'post' => $bachFlower
        ]);
    }

    /**
     * 
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request,  BachFlower $bachFlower): Response
    {
        $form = $this->createForm(PostType::class, $bachFlower);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $bachFlower->setUpdatedAt(new \DateTimeImmutable());
            $bachFlower->setSlug(null);
            $this->manager->flush();

            return $this->redirectToRoute('back_bachFlower_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/edit.html.twig', [
            'post' => $bachFlower,
            'form' => $form,
        ]);
    }

    /**
     * 
     * @Route("/add/post", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bachFlower = new BachFlower();
        $form = $this->createForm(PostType::class, $bachFlower);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($bachFlower);
            $entityManager->flush();

            return $this->redirectToRoute('back_bachFlower_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/add.html.twig', [
            'post' => $bachFlower,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(BachFlower $bachFlower)
    {
        $this->manager->remove($bachFlower);
        $this->manager->flush();

        return $this->redirectToRoute('back_bachFlower_browse');
    }
}
