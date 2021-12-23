<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("product/{id}", name="product_show")
     */
    public function __invoke($id, ManagerRegistry $manager): Response
    {

        $repository = $manager->getRepository(Product::class);
        $product = $repository->findOneBy(['id' => $id]);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        //$category = $manager->getRepository(Category1::class)->find($id);
        dump($product->getName());
        return $this->render('product/productShow.html.twig',[
            'product' => $product,
        ]);
    }
}