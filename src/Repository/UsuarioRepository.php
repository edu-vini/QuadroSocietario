<?php

namespace App\Repository;

use App\Entity\Usuario;
use Doctrine\Persistence\ManagerRegistry;

class UsuarioRepository extends AbstractRepository {
    protected string $entityManager = Usuario::class;
    public function __contruct(ManagerRegistry $managerRegistry){
        parent::__construct($managerRegistry);
    }
}