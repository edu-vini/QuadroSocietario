<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\Type\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController {
    #[Route(path: 'login', name: 'form_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response {
        
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('login/login.html.twig',[
            'error' => $error
        ]);
    }
}