<?php

namespace App\Controller;

use App\Entity\Category1;
use App\Form\CategoryFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryFormController extends AbstractController
{
    /**
     * @Route("newCategory", name="new_category")
     */
    public function new(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(CategoryFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /** @var Category1 $category */
            $category = $form->getData();

            $manager->persist($category);
            $manager->flush();

            $this->addFlash('succes', 'Category added! Congrats! =D');

            return $this->redirectToRoute('home');
        }
        return $this->render('category_form/new.html.twig',
            [
                'categoryForm' =>$form->createView(),
            ]);
    }
}