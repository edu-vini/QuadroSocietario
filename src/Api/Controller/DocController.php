<?php

namespace App\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DocController extends AbstractController {

    #[Route(path: '/docs')]
    public function docs(): Response {
        return $this->render('docs\index.html.twig');
    }

    #[Route(path: '/swagger.json', name:'json_swagger')]
    public function swaggerJson(): Response {
        $openapi = \OpenApi\Generator::scan(['C:\Des\Symfony\quadroSocietario\src']);
        $response = new Response($openapi->toJson(), Response::HTTP_OK, ['Content-Type'=> 'application/json']);
        return $response;
    }

}