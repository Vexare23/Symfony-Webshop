<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\Persistence\ManagerRegistry;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewTags extends AbstractController
{
    /**
     * @Route("viewAllTags", name="view_tags")
     */
    public function __invoke(ManagerRegistry $manager, TagRepository $repository): Response
    {
        $tag = $repository->createAskedOrderByNewestQueryBuilder();

        $pagerfanta = new Pagerfanta(
            new QueryAdapter($tag)
        );
        $pagerfanta->setMaxPerPage(10);

        return $this->render('tag/allTags.html.twig',[
            'pager' => $pagerfanta,
        ]);
    }
}