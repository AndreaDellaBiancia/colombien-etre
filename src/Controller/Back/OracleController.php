<?php

namespace App\Controller\Back;

use App\Entity\Oracle;
use App\Form\OracleType;
use App\Repository\OracleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/backoffice/oracle", name="back_oracle_")
 */
class OracleController extends AbstractController
{

    private $manager;


    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }


    /**
     * @Route("", name="browse")
     */
    public function browse(OracleRepository $oracles): Response
    {
        return $this->render('back/oracle/browse.html.twig', [
            'oracles' => $oracles->findBy([], ['id' => 'DESC'])
        ]);
    }

    /**
     * @Route("/{id}", name="read")
     */
    public function read( Oracle $oracle): Response
    {
        return $this->render('back/oracle/read.html.twig', [
            'oracle' => $oracle
        ]);
    }

    /**
     * 
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request,  Oracle $oracle): Response
    {
        $form = $this->createForm(OracleType::class, $oracle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $oracle->setUpdatedAt(new \DateTimeImmutable());
            $this->manager->flush();

            return $this->redirectToRoute('back_oracle_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/oracle/edit.html.twig', [
            'oracle' => $oracle,
            'form' => $form,
        ]);
    }

    /**
     * 
     * @Route("/add/post", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $oracle = new Oracle();
        $form = $this->createForm(OracleType::class, $oracle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($oracle);
            $entityManager->flush();

            return $this->redirectToRoute('back_oracle_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/oracle/add.html.twig', [
            'oracle' => $oracle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Oracle $oracle)
    {
        $this->manager->remove($oracle);
        $this->manager->flush();

        return $this->redirectToRoute('back_oracle_browse');
    } 
}


