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

class EditTag extends AbstractController
{
    /**
     * @Route("editTag/{id}", name="edit_tag")
     */
    public function edit(Tag $tag, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(TagFormType::class, $tag);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Tag $tag */
            $tag = $form->getData();
            $newdata = $tag->getProd();
            foreach ($tag->getProd() as $prod)
            {
                dump($prod);
                $tag->removeProd($prod);
                dump($tag->getProd());
            }
            die;
            foreach ($newdata as $prod)
            {
                $tag->addProd($prod);
            }
            foreach ($tag->getProd() as $prod)
            {
                dump($prod);
            }
            die;
            $manager->persist($tag);
            $manager->flush();

            $this->addFlash('succes', 'Tag updated! Congrats! =D');

            return $this->redirectToRoute('home');
        }
        return $this->render('edit_tag/new.html.twig',
            [
                'tagForm' => $form->createView(),
            ]);
    }
}