<?php

namespace App\Controller;

use App\Entity\Category1;
use App\Entity\Product;
use App\Form\CategoryFormType;
use App\Form\ProductFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteProduct extends AbstractController
{
    /**
     * @Route("deleteProduct/{id}", name="delete_product")
     */
    public function __invoke(Request $request, Product $product, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(ProductFormType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager->remove($product);
            $manager->flush();

            $this->addFlash('success', 'Product deleted successfully');

            return $this->redirectToRoute('home');
            }

        return $this->render('delete_product/index.html.twig', [
            'productForm' => $form->createView(),
        ]);
    }
}