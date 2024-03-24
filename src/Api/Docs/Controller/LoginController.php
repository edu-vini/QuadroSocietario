<?php

namespace App\Api\Docs\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Token',
)]
abstract class LoginController {
    #[OA\Post(
        path: '/api/login',
        summary: 'Gerar Token de Acesso',
        tags: ['Token'],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'login', type: 'string'),
                    new OA\Property(property: 'password', type: 'string'),
                ]
            )
        ),
        responses:[
            new OA\Response(response: '200', description: 'Json Contendo o Access Token.')
        ]
    )]
    abstract function login();
}

