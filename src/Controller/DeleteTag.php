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

class DeleteTag extends AbstractController
{
    /**
     * @Route("deleteTag/{id}", name="delete_tag")
     */
    public function __invoke(Request $request, Tag $tag, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(TagFormType::class, $tag);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->remove($tag);
            $manager->flush();

            $this->addFlash('success', 'Tag deleted successfully');

            //return $this->redirectToRoute($_SERVER['HTTP_REFERER'] );

            return $this->redirectToRoute('home');
        }

        return $this->render('delete_tag/index.html.twig', [
            'tagForm' => $form->createView(),
        ]);
    }
}