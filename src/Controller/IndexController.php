<?php

declare(strict_types=1);

namespace App\Controller;

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
    public function __invoke(): Response
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Food'
            ],
            [
                'id' => 2,
                'name' => 'Drinks'
            ],
            [
                'id' => 3,
                'name' => 'Accessories'
            ]
        ];

        dump($categories);

        return $this->render('index/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}
