<?php

namespace App\Api\Docs\Controller;

use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;

abstract class EmpresaController {
    #[OA\Get(
        path:'/api/empresa',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo as Empresas.')
        ],
        tags: [
            'Empresa'
        ],
        summary: "Buscar todas as Empresas."
    )]
    abstract function getAll();

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
        ],
        summary: "Buscar uma Empresa."
    )]
    abstract function get(int $id);

    #[OA\Post(
        path: '/api/empresa',
        responses: [
            new OA\Response(response: '200', description: 'Empresa Incluída com Sucesso!')
        ],
        requestBody: new OA\RequestBody(ref: '#components/requestBodies/Empresa'),
        tags: [
            'Empresa'
        ],
        summary: "Adicionar uma nova Empresa."
    )]
    abstract function post(Request $request);

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
        ],
        summary: "Atualizar uma Empresa."
    )]
    abstract function put(int $id);

    #[OA\Get(
        path: '/api/empresa/{id}/socios',
        responses: [
            new OA\Response(response: 200, description: 'JSON Contendendo Sócios da Empresa.')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id', name: 'id')
        ],
        tags: [
            'Empresa'
        ],
        summary: "Buscar os Sócios de uma Empresa."
    )]
    abstract function getSocios(int $id);

    #[OA\Delete(
        path: '/api/empresa/{id}',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo a Empresas.')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id',name: 'id')
        ],
        tags: [
            'Empresa'
        ],
        summary: "Excluir uma Empresa."
    )]
    abstract function delete(int $id);
    
}