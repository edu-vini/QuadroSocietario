<?php

namespace App\Api\Entity;

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
            new OA\Property(property: 'telefone', type: 'string')
        ]
    )
)]

#[OA\Tag(
    name: 'Sócio',
)]
class Socio {

}