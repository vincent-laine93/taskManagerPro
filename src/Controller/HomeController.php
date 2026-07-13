<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/')]
    public function home(): Response
    {
        return $this->render('home/home.html.twig');
    }

    #[Route('/presentation')]
    public function index(): Response
    {
        $identite = [
            'nom'    => "LAINE",
            'prenom'    => "Vincent",
            'age'    => 21
        ];

        return $this->render('home/presentation.html.twig', [
            'identite' => $identite
        ]);
    }

    #[Route('/hello')]
    public function hello(): Response
    {
        return new Response('Hello, World!');
    }
}