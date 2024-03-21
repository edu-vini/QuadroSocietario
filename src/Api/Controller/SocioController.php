<?php

namespace App\Api\Controller;

use App\Repository\SocioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;

#[Route(path: '/api/socio')]
class SocioController extends AbstractController {
    private SocioRepository $socioRepository;
    public function __construct(SocioRepository $socioRepository){
        $this->socioRepository = $socioRepository;
    }

    #[OA\Get(
        path: '/api/socio',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo as Empresas.')
        ],
        tags: [
            'Sócio'
        ]
    )]
    #[Route(path: '/', methods: ['GET'])]
    public function getAll(): Response {
        return $this->json($this->socioRepository->findAll());
    }

    #[OA\Get(
        path: '/api/socio/{id}',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo a Empresas.')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id',name: 'id')
        ],
        tags: [
            'Sócio'
        ]
    )]
    #[Route(path: '/{id}', methods: ['GET'])]
    public function get(int $id): Response {
        return $this->json($this->socioRepository->find($id));
    }

    #[OA\Post(
        path: '/api/socio',
        responses: [
            new OA\Response(response: '200', description: 'Empresa Criada com Sucesso!')
        ],
        requestBody: new OA\RequestBody(ref: '#components/requestBodies/Socio'),
        tags: [
            'Sócio'
        ]
    )]
    #[Route(path: '/api/socio', methods: ['POST'])]
    public function post(Request $request): Response {
        return $this->json('Empresa Criada com Sucesso!');
    }

    #[OA\Put(
        path: '/api/socio/{id}',
        responses: [
            new OA\Response(response: '200', description: 'Empresa Criada com Sucesso!')
        ],
        requestBody: new OA\RequestBody(ref: '#components/requestBodies/Socio'),
        tags: [
            'Sócio'
        ]
    )]
    #[Route(path: '/{id}', methods: ['PUT'])]
    public function put(int $id, Request $request): Response {
        return $this->json('Empresa Criada com Sucesso!');
    }
}