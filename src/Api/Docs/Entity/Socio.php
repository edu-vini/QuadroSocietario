<?php

namespace App\Api\Docs\Entity;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Socio',
    type: 'object',
    properties: [
        new OA\Property(property: 'id', type: 'integer'),
        new OA\Property(property: 'cpf', type: 'string'),
        new OA\Property(property: 'nome', type: 'string'),
        new OA\Property(property: 'endereco', type: 'string'),
        new OA\Property(property: 'telefone', type: 'string')
    ]
)]

#[OA\RequestBody(
    request: 'Socio',
    content: new OA\JsonContent(
        title: 'Socio',
        schema: 'Socio',
        type: 'object',
        properties: [
            new OA\Property(property: 'cpf', type: 'string'),
            new OA\Property(property: 'nome', type: 'string'),
            new OA\Property(property: 'endereco', type: 'string'),
            new OA\Property(property: 'telefone', type: 'string'),
            new OA\Property(
                property: 'empresas', 
                type: 'array',
                items: new OA\Items( 
                    properties: [
                        new OA\Property(property: 'id', type: 'integer'),
                    ]
                )
            )
        ]
    )
)]

#[OA\Tag(
    name: 'Sócio',
)]
class Socio {

}