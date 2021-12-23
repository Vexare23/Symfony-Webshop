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

class ProductFormController extends AbstractController
{
    /**
     * @Route("newProduct", name="new_product")
     */
    public function new(EntityManagerInterface $manager, Request $request): Response
    {

        $form = $this->createForm(ProductFormType::class);
        $form->handleRequest($request);
        //dd($form);
        if($form->isSubmitted() && $form->isValid()){
            /** @var Product $product */
            $product = $form->getData();

            $manager->persist($product);
            $manager->flush();

            $this->addFlash('success', 'Product added! Congrats! =D');

            return $this->redirectToRoute('home');
        }

        return $this->render('product_form/new.html.twig',
            [
                'productForm' =>$form->createView(),
            ]);
    }

}