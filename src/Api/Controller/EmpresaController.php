<?php

namespace App\Api\Controller;

use App\Repository\EmpresaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;



#[Route(path: '/api/empresa')]
class EmpresaController extends AbstractController {

    private EmpresaRepository $empresaRepository;

    public function __construct(EmpresaRepository $empresaRepository){
        $this->empresaRepository = $empresaRepository;
    }
    
    #[OA\Get(
        path:'/api/empresa',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo as Empresas.')
        ],
        tags: [
            'Empresa'
        ]
    )]
    #[Route(path: '/', methods: ['GET'])]
    public function getAll(): Response {
        return $this->json($this->empresaRepository->findAll());
    }
    
    #[OA\Get(
        path:'/api/empresa/{id}',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo uma Empresa.')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id',name: 'id')
        ],
        tags: [
            'Empresa'
        ]
    )]
    #[Route(path: '/{id}', methods: ['GET'])]
    public function get (int $id ): Response {
        return $this->json($this->empresaRepository->find($id));
    }

    #[OA\Post(
        path: '/api/empresa',
        responses: [
            new OA\Response(response: '200', description: 'Empresa Incluída com Sucesso!')
        ],
        requestBody: new OA\RequestBody(ref: '#components/requestBodies/Empresa'),
        tags: [
            'Empresa'
        ]
    )]
    #[Route(path: '/', methods: ['POST'])]
    public function post (Request $request): Response {
        return $this->json('Empresa Incluída com Sucesso!');
    }

    #[OA\Put(
        path: '/api/empresa/{id}',
        responses: [
            new OA\Response(response: '200', description: 'Empresa Editada com Sucesso!')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id',name: 'id')
        ],
        requestBody: new OA\RequestBody(ref: '#components/requestBodies/Empresa'),
        tags: [
            'Empresa'
        ]
    )]
    #[Route(path: '/{id}', methods: ['PUT'])]
    public function put (int $id, Request $request): Response {
        return $this->json('Empresa Atualizada com Sucesso!');
    }
}