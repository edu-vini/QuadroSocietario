<?php

namespace App\Repository;

use App\Entity\Socio;
use App\Service\SocioService;
use Doctrine\Persistence\ManagerRegistry;

class SocioRepository extends AbstractRepository {
    protected string $entityManager = Socio::class;
    public function __construct(
        private SocioService $socioService,
        ManagerRegistry $managerRegistry
    ){
        parent::__construct($managerRegistry);
    }
    public function save($socio){
        $this->socioService->removeChars($socio);
        $this->getEntityManager()->persist($socio);
        $this->getEntityManager()->flush();
    }
}