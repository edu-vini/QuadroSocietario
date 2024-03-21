<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController {
    #[Route(name: 'home')]
    public function home(): Response {
        return $this->render('home/home.html.twig');
    }
    #[Route(path: '/swagger.json', name:'json_swagger')]
    public function swaggerJson(): Response {
        $openapi = \OpenApi\Generator::scan(['C:\Des\Symfony\quadroSocietario\src\Api']);
        $response = new Response($openapi->toJson(), Response::HTTP_OK, ['Content-Type'=> 'application/json']);
        return $response;
    }
    #[Route(path: '/docs', name:'docs')]
    public function docs(): Response {
        return $this->render('swagger-ui\index.html.twig');
    }



}