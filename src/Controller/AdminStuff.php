<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminStuff extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function __invoke(ManagerRegistry $manager): Response
    {
        return $this->render('admin.html.twig');
    }
}