<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category1;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatgegoryController extends AbstractController
{
    private LoggerInterface $log;

    /**
     * @Route("category/{id}", name="category_show")
     */
    public function __invoke($id, ManagerRegistry $manager): Response
    {

        $repository = $manager->getRepository(Category1::class);
        $category = $repository->findOneBy(['id' => $id]);
        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for id '.$id
            );
        }
        //$category = $manager->getRepository(Category1::class)->find($id);
        dump($category->getName());
        $this->log->info($category->getName());
        dump($category->getProducts());

        if (!$this->isGranted('ROLE_ADMIN')) {
            $isAdmin = false;
        }
        dump($isAdmin);
        return $this->render('category/categoryShow.html.twig',[
            'isAdmin' => $isAdmin,
            'category' => $category,
        ]);
    }

    public function __construct(private LoggerInterface $logger)
    {
        $this->log = $logger;
    }

}