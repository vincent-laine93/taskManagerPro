<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SecurityController extends AbstractController
{
    #[Route('/', methods: ['GET', 'POST'], name: 'app_login')]
    public function login(Request $request, UserRepository $userRepository, SessionInterface $session): Response
    {
        if ($request->isMethod('POST')) {

            // Récupérer les données du formulaire
            $email = $request->request->get('email');
            $password = $request->request->get('password');

            // Vérifier les identifiants de l'utilisateur dans la base de données
            $user = $userRepository->findOneBy(['email' => $email]);

            // Vérifier si l'utilisateur existe et si le mot de passe correspond
            if ($user && $user->getPassword() === $password) {
                // Stocker l'id utilisateur dans la session
                $session->set('user_id', $user->getId());
                // Authentification réussie, rediriger vers la page d'accueil
                return $this->redirectToRoute('app_home');
            } else {
                // Authentification échouée, afficher un message d'erreur
                $this->addFlash('error', 'Identifiants invalides.');    
            }
        }
        return $this->render('security/login.html.twig');
    }
} 