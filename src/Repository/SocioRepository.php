<?php

namespace App\Repository;

use App\Entity\Socio;
use Doctrine\Persistence\ManagerRegistry;

class SocioRepository extends AbstractRepository {
    protected string $entityManager = Socio::class;
    public function __construct(ManagerRegistry $managerRegistry){
        parent::__construct($managerRegistry);
    }
}