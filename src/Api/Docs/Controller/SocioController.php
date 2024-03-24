<?php
namespace App\Api\Docs\Controller;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;

abstract class SocioController {
    #[OA\Get(
        path: '/api/socio',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo os Sócios.')
        ],
        tags: [
            'Sócio'
        ],
        summary: "Buscar todos os Sócios."
    )]
    abstract function getAll();

    #[OA\Get(
        path: '/api/socio/{id}',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo o Sócio.')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id',name: 'id')
        ],
        tags: [
            'Sócio'
        ],
        summary: "Buscar um Sócio."
    )]
    abstract function get(int $id);
    
    #[OA\Post(
        path: '/api/socio',
        responses: [
            new OA\Response(response: '200', description: 'Sócio Criado com Sucesso!')
        ],
        requestBody: new OA\RequestBody(ref: '#components/requestBodies/Socio'),
        tags: [
            'Sócio'
        ],
        summary: "Adicionar um novo Sócio."
    )]
    abstract function post(Request $request);
    
    #[OA\Put(
        path: '/api/socio/{id}',
        responses: [
            new OA\Response(response: '200', description: 'Sócio Atualizado com Sucesso!')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id',name: 'id')
        ],
        requestBody: new OA\RequestBody(ref: '#components/requestBodies/Socio'),
        tags: [
            'Sócio'
        ],
        summary: "Atualizar um Sócio."
    )]
    abstract function put();
    
    #[OA\Delete(
        path: '/api/socio/{id}',
        responses: [
            new OA\Response(response: '200', description: 'Sócio Excluído com Sucesso!')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id',name: 'id')
        ],
        tags: [
            'Sócio'
        ],
        summary: "Excluir um Sócio."
    )]
    abstract function delete();

    #[OA\Delete(
        path: '/api/socio/{idSocio}/empresa/{idEmpresa}',
        responses: [
            new OA\Response(response: '200', description: 'Empresa Removida do Sócio!')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'idSocio',name: 'idSocio'),
            new OA\PathParameter(parameter: 'idEmpresa',name: 'idEmpresa')
        ],
        tags: [
            'Sócio'
        ],
        summary: "Remover Empresa do Sócio."
    )]
    abstract function deleteEmpresa();
}

