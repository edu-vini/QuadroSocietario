<?php

namespace App\Security;
use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class Roles {
    public static function get(): array {
        return [
            'Administrador'=>'ROLE_ADMIN',
            'Usuário'=>'ROLE_USER',
            'Empresa'=>'ROLE_EMPRESA',
            'Sócio'=>'ROLE_SOCIO'
        ];
    }
}