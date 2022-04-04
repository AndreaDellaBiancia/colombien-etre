<?php

namespace App\Controller\Back;

use App\Entity\Feed;
use App\Form\PostType;
use App\Repository\FeedRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/backoffice/alimentation", name="back_feed_")
 */
class FeedController extends AbstractController
{

    private $manager;


    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("", name="browse")
     */
    public function browse(FeedRepository $feedRepository): Response
    {
        return $this->render('back/corpsEsprit/browse.html.twig', [
            'posts' => $feedRepository->findBy([], ['id' => 'DESC']),
            'category' => 'feed',
            'pageTitle' => 'Alimentation' 
        ]);
    }

    /**
     * @Route("/{id}", name="read")
     */
    public function read(Feed $feed): Response
    {
        return $this->render('back/corpsEsprit/read.html.twig', [
            'post' => $feed
        ]);
    }

    /**
     * 
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request,  Feed $feed): Response
    {
        $form = $this->createForm(PostType::class, $feed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $feed->setUpdatedAt(new \DateTimeImmutable());
            $feed->setSlug(null);
            $this->manager->flush();

            return $this->redirectToRoute('back_feed_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/edit.html.twig', [
            'post' => $feed,
            'form' => $form,
        ]);
    }

    /**
     * 
     * @Route("/add/post", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $feed = new Feed();
        $form = $this->createForm(PostType::class, $feed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($feed);
            $entityManager->flush();

            return $this->redirectToRoute('back_feed_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/corpsEsprit/add.html.twig', [
            'post' => $feed,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Feed $feed)
    {
        $this->manager->remove($feed);
        $this->manager->flush();

        return $this->redirectToRoute('back_feed_browse');
    }
}
