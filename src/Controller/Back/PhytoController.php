<?php

namespace App\Controller\Back;

use App\Entity\Phyto;
use App\Form\PostType;
use App\Repository\PhytoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * 
 * @Route("/backoffice/phytotherapie", name="back_phyto_")
 */
class PhytoController extends AbstractController
{

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("", name="browse")
     */
    public function browse(PhytoRepository $phytoRepository): Response
    {
        return $this->render('back/corpsEsprit/browse.html.twig', [
            'posts' => $phytoRepository->findBy([], ['id' => 'DESC']),
            'category' => 'phyto',
            'pageTitle' => 'Phytotérapie' 
        ]);
    }

    /**
     * @Route("/{id}", name="read")
     */
    public function read(Phyto $phyto): Response
    {
        return $this->render('back/corpsEsprit/read.html.twig', [
            'post' => $phyto
        ]);
    }

    /**
     * 
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request,  Phyto $phyto): Response
    {
        $form = $this->createForm(PostType::class, $phyto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $phyto->setUpdatedAt(new \DateTimeImmutable());
            $phyto->setSlug(null);
            $this->manager->flush();

            return $this->redirectToRoute('back_phyto_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/edit.html.twig', [
            'post' => $phyto,
            'form' => $form,
        ]);
    }

    /**
     * 
     * @Route("/add/post", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $phyto = new Phyto();
        $form = $this->createForm(PostType::class, $phyto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($phyto);
            $entityManager->flush();

            return $this->redirectToRoute('back_phyto_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/add.html.twig', [
            'post' => $phyto,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Phyto $phyto)
    {
        $this->manager->remove($phyto);
        $this->manager->flush();

        return $this->redirectToRoute('back_phyto_browse');
    }
}
