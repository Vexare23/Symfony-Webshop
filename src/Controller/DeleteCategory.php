<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category1;
use App\Form\CategoryFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class DeleteCategory extends AbstractController
{
    /**
     * @Route("deleteCategory/{id}", name="delete_category")
     */
    public function __invoke(Request $request, Category1 $category, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(CategoryFormType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /*
            if($category->getProducts()->isEmpty())
            {
            */
                $manager->remove($category);
                $manager->flush();

                $this->addFlash('success', 'Category deleted successfully');

                return $this->redirectToRoute('home');
            //}
        } else {
            $this->addFlash('failed', 'A Category that still contains Products cannot be deleted!');
        }

        return $this->render('delete_category/index.html.twig', [
            'categoryForm' => $form->createView(),
        ]);
    }
}