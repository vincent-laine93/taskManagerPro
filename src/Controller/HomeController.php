<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function home(SessionInterface $session, UserRepository $userRepository): Response
    {

        $userId = $session->get('user_id');
        
        if (!$userId) {
            return $this->redirectToRoute('app_login');
        }

        $user = $userRepository->find($userId);

        return $this->render('home/home.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(SessionInterface $session): Response
    {
        // Supprimer l'id utilisateur de la session
        $session->remove('user_id');    

        // Rediriger vers la page de connexion
        return $this->redirectToRoute('app_login');
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