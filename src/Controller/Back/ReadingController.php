<?php

namespace App\Controller\Back;

use App\Entity\ReadingSpirituality;
use App\Form\ReadingType;
use App\Repository\ReadingSpiritualityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/backoffice/reading", name="back_reading_")
 */
class ReadingController extends AbstractController
{

    private $manager;


    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }


    /**
     * @Route("", name="browse")
     */
    public function browse(ReadingSpiritualityRepository $reading): Response
    {
        return $this->render('back/reading/browse.html.twig', [
            'readings' => $reading->findBy([], ['id' => 'DESC'])
        ]);
    }

    /**
     * @Route("/{id}", name="read")
     */
    public function read( ReadingSpirituality $reading): Response
    {
        return $this->render('back/reading/read.html.twig', [
            'reading' => $reading
        ]);
    }

    /**
     * 
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request,  ReadingSpirituality $reading): Response
    {
        $form = $this->createForm(ReadingType::class, $reading);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $reading->setUpdatedAt(new \DateTimeImmutable());
            $this->manager->flush();

            return $this->redirectToRoute('back_reading_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/reading/edit.html.twig', [
            'reading' => $reading,
            'form' => $form,
        ]);
    }

    /**
     * 
     * @Route("/add/post", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reading = new ReadingSpirituality();
        $form = $this->createForm(ReadingType::class, $reading);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($reading);
            $entityManager->flush();

            return $this->redirectToRoute('back_reading_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/reading/add.html.twig', [
            'reading' => $reading,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(ReadingSpirituality $reading)
    {
        $this->manager->remove($reading);
        $this->manager->flush();

        return $this->redirectToRoute('back_reading_browse');
    } 
}


