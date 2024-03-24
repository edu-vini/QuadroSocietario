<?php

namespace App\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi as OA;
class DocController extends AbstractController {

    #[Route(path: '/docs')]
    public function docs(): Response {
        return $this->render('docs\index.html.twig');
    }

    #[Route(path: '/swagger.json', name:'json_swagger')]
    public function swaggerJson(): Response {
        return $this->json(OA\Generator::scan(['../src/Api/Docs']));
    }

}