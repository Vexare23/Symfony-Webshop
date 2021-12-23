<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category1;
use App\Form\CategoryFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditCategory extends AbstractController
{
    /**
     * @Route("editCategory/{id}", name="edit_category")
     */
    public function edit(Category1 $category, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(CategoryFormType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Category1 $category */
            $category = $form->getData();

            $manager->persist($category);
            $manager->flush();

            $this->addFlash('success', 'Category updated! Congrats! =D');

            return $this->redirectToRoute('home');
        }
        return $this->render('edit_category/new.html.twig',
            [
                'categoryForm' => $form->createView(),
            ]);
    }
}