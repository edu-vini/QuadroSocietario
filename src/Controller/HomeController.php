<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class HomeController extends AbstractController {
    #[Route(path:'/home', name: 'home')]
    public function home(): Response {
        return $this->render('home/home.html.twig');
    }

    #[Route(path: '/', name: 'root')]
    public function root(): Response {
        return $this->redirectToRoute('home');
    }

}