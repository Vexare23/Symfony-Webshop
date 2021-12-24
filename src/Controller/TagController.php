<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Tag;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * @Route("tag/{id}", name="tag_show")
     */
    public function __invoke($id, ManagerRegistry $manager): Response
    {
        $repository = $manager->getRepository(Tag::class);
        $tag = $repository->findOneBy(['id' => $id]);
        if (!$tag) {
            throw $this->createNotFoundException(
                'No tag found for id'.$id
            );
        }
        dump($tag->getName());
        return $this->render('tag/tagShow.html.twig', [
            'tag' => $tag,
        ]);
    }
}