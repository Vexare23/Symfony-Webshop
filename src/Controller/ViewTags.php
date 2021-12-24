<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Tag;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewTags extends AbstractController
{
    /**
     * @Route("viewAllTags", name="view_tags")
     */
    public function __invoke(ManagerRegistry $manager): Response
    {
        $repository = $manager->getRepository(Tag::class);
        $tag = $repository->findAll();
        return $this->render('tag/allTags.html.twig',[
            'tag' => $tag,
        ]);
    }
}