<?php

namespace App\Controller\Back;

use App\Entity\VideoSpirituality;
use App\Form\VideoType;
use App\Repository\VideoSpiritualityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/backoffice/videos", name="back_video_")
 */
class VideoController extends AbstractController
{
    
    private $manager;


    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("", name="browse")
     */
    public function browse(VideoSpiritualityRepository $videoSpirituality): Response
    {
        return $this->render('back/video/browse.html.twig', [
            'videos' => $videoSpirituality->findBy([], ['id' => 'DESC'])
        ]);
    }

    /**
     * @Route("/{id}", name="read")
     */
    public function read( VideoSpirituality $video): Response
    {
        return $this->render('back/video/read.html.twig', [
            'video' => $video
        ]);
    }

    /**
     * 
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request,  VideoSpirituality $video): Response
    {
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $video->setUpdatedAt(new \DateTimeImmutable());
            $this->manager->flush();

            return $this->redirectToRoute('back_video_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/video/edit.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }

    /**
     * 
     * @Route("/add/post", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $video = new VideoSpirituality();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($video);
            $entityManager->flush();

            return $this->redirectToRoute('back_video_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/video/add.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(VideoSpirituality $video)
    {
        $this->manager->remove($video);
        $this->manager->flush();

        return $this->redirectToRoute('back_video_browse');
    } 
}
