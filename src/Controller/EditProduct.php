<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditProduct extends AbstractController
{
    /**
     * @Route("editProduct/{id}", name="edit_product")
     */
    public function edit(Product $product, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(ProductFormType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Product $product */
            $product = $form->getData();

            $manager->persist($product);
            $manager->flush();

            $this->addFlash('succes', 'Product updated! Congrats! =D');

            return $this->redirectToRoute('home');
        }
        return $this->render('edit_product/new.html.twig',
            [
                'productForm' => $form->createView(),
            ]);
    }
}