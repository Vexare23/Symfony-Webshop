<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagFormController extends AbstractController
{
    /**
     * @Route("newTag", name="new_tag")
     */
    public function new(EntityManagerInterface $manager, Request $request): Response
    {

        $form = $this->createForm(TagFormType::class);
        $form->handleRequest($request);
        //dd($form);
        if ($form->isSubmitted() && $form->isValid()) {
            ///** @var Tag $tag */
            $tag = $form->getData();

            $manager->persist($tag);
            $manager->flush();

            $this->addFlash('success', 'Tag added! Congrats! =D');

            return $this->redirectToRoute('home');
        }

        return $this->render('tag_form/new.html.twig',
            [
                'tagForm' => $form->createView(),
            ]);
    }
}