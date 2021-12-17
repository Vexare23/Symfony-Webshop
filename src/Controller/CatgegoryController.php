<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatgegoryController extends AbstractController
{
    private LoggerInterface $log;

    /**
     * @Route("category/{name}", name="category_show")
     */
    public function __invoke($name): Response
    {
        dump($name);
        $this->log->info($name);
        return $this->render('category/categoryShow.html.twig',[
            'categoryName' => $name
        ]);
    }

    public function __construct(private LoggerInterface $logger)
    {
        $this->log = $logger;
    }

}