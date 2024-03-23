<?php

namespace App\Security;

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