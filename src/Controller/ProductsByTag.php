<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Tag;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsByTag extends AbstractController
{
    /**
     * @Route("products/byTag/{id}", name="productsByTag_show")
     */
    public function __invoke($id, ManagerRegistry $manager): Response
    {
        $repository = $manager->getRepository(Tag::class);
        $tag = $repository->findOneBy(['id' => $id]);
        //$tag = $repository->findAll();
        $products = $tag->getProd();

        return $this->render('ProdByTags.html.twig', [
            'prodByTag' => $products,
            'tag' => $tag->getName()
        ]);
    }
}