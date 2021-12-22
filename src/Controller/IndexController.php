<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category1;
//use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCodeBundle\Response\QrCodeResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class   IndexController extends AbstractController
{
    private $qrCode;

    public function __construct(BuilderInterface $customQrCodeBuilder)
    {

        $result = $customQrCodeBuilder
            ->size(200)
            ->margin(20)
            ->build();

        $qrCode = new QrCodeResponse($result);
    }
    /**
     * @Route("/", name="home")
     */
    public function __invoke(ManagerRegistry $manager): Response
    {
        $repository = $manager->getRepository(Category1::class)->findAll();

        dump($repository);

        return $this->render('index/index.html.twig', [
            'categories' => $repository,
        ]);
    }
}
