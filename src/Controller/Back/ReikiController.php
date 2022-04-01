<?php

namespace App\Controller\Back;

use App\Entity\Reiki;
use App\Form\PostType;
use App\Repository\ReikiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/backoffice/reiki", name="back_reiki_")
 */
class ReikiController extends AbstractController
{

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("", name="browse")
     */
    public function browse(ReikiRepository $reikiRepository): Response
    {
        return $this->render('back/corpsEsprit/browse.html.twig', [
            'posts' => $reikiRepository->findBy([], ['id' => 'DESC']),
            'category' => 'reiki',
            'pageTitle' => 'Reiki' 
        ]);
    }

    /**
     * @Route("/{id}", name="read")
     */
    public function read(Reiki $reiki): Response
    {
        return $this->render('back/corpsEsprit/read.html.twig', [
            'post' => $reiki
        ]);
    }

    /**
     * 
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request,  Reiki $reiki): Response
    {
        $form = $this->createForm(PostType::class, $reiki);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $reiki->setUpdatedAt(new \DateTimeImmutable());
            $reiki->setSlug(null);
            $this->manager->flush();

            return $this->redirectToRoute('back_reiki_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/edit.html.twig', [
            'post' => $reiki,
            'form' => $form,
        ]);
    }

    /**
     * 
     * @Route("/add/post", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reiki = new Reiki();
        $form = $this->createForm(PostType::class, $reiki);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($reiki);
            $entityManager->flush();

            return $this->redirectToRoute('back_reiki_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/add.html.twig', [
            'post' => $reiki,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Reiki $reiki)
    {
        $this->manager->remove($reiki);
        $this->manager->flush();

        return $this->redirectToRoute('back_reiki_browse');
    }
}
