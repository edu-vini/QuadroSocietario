<?php

namespace App\Repository;

use App\Entity\Empresa;
use Doctrine\Persistence\ManagerRegistry;

class EmpresaRepository extends AbstractRepository {
    protected string $entityManager = Empresa::class;
    public function __construct(ManagerRegistry $managerRegistry){
        parent::__construct($managerRegistry);
    }
}