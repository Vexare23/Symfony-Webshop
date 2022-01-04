<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

class ViewProducts extends AbstractController
{
    /**
     * @Route("viewAllProducts", name="view_products")
     */
    public function __invoke(ManagerRegistry $manager): Response
    {
        $repository = $manager->getRepository(Product::class);
        $product = $repository->findAll();
        return $this->render('product/allProducts.html.twig',[
            'products' => $product,
        ]);
    }
}