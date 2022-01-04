<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Tag;
use Doctrine\Persistence\ManagerRegistry;
use Pagerfanta\Doctrine\Collections\CollectionAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsByTag extends AbstractController
{
    /**
     * @Route("products/byTag/{id}", name="productsByTag_show")
     */
    public function __invoke($id, ManagerRegistry $manager, Request $request): Response
    {
        $repository = $manager->getRepository(Tag::class);
        $tag = $repository->findOneBy(['id' => $id]);

        $adapter = new  CollectionAdapter($tag->getProd());
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(5);
        //$pagerfanta->setCurrentPage($request->query->get('page', 1));

        //$tag = $repository->findAll();
        //$products = $tag->getProd();

        return $this->render('ProdByTags.html.twig', [
            'pager' => $pagerfanta,
            'tag' => $tag->getName()
        ]);
    }
}