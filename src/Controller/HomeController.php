<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'home', methods: ['GET'])]
    public function alchemy(): Response
    {
        return $this->render('home.html.twig', [
            'utils' => [
                'Skyrim' => $this->generateUrl('skyrim_alchemy'),
            ],
        ]);
    }
}
