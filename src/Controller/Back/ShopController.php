<?php

namespace App\Controller\Back;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/back/shop", name="back_shop_")
 */
class ShopController extends AbstractController
{

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("", name="browse")
     */
    public function browse(ProductRepository $productRepository): Response
    {

        $products = $productRepository->findBy([], ['id' => 'DESC']);

        return $this->render('back/shop/browse.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/{id}", name="read")
     */
    public function read(Product $product): Response
    {
        return $this->render('back/shop/read.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * 
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $product->setUpdatedAt(new \DateTimeImmutable());
            $this->manager->flush();

            return $this->redirectToRoute('back_shop_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/shop/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * 
     * @Route("/add/product", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('back_shop_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/shop/add.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Product $product)
    {
        $this->manager->remove($product);
        $this->manager->flush();

        return $this->redirectToRoute('back_shop_browse');
    }
}
