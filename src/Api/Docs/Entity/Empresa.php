<?php

namespace App\Api\Docs\Entity;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Empresa',
    type: 'object',
    properties: [
        new OA\Property(property: 'id', type: 'integer'),
        new OA\Property(property: 'cpf', type: 'string'),
        new OA\Property(property: 'razaoSocial', type: 'string'),
        new OA\Property(property: 'fantasia', type: 'string'),
        new OA\Property(property: 'endereco', type: 'string'),
        new OA\Property(property: 'telefone', type: 'string')
    ]
)]

#[OA\RequestBody(
    request: 'Empresa',
    content: new OA\JsonContent(
        title: 'Empresa',
        schema: 'Empresa',
        type: 'object',
        properties: [
            new OA\Property(property: 'cnpj', type: 'string'),
            new OA\Property(property: 'razaoSocial', type: 'string'),
            new OA\Property(property: 'fantasia', type: 'string'),
            new OA\Property(property: 'endereco', type: 'string'),
            new OA\Property(property: 'telefone', type: 'string')
        ]
    )
)]

#[OA\Tag(
    name: 'Empresa',
)]
class Empresa {

}