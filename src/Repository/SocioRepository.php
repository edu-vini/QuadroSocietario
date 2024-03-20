<?php

namespace App\Repository;

use App\Entity\Socio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SocioRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $managerRegistry){
        parent::__construct($managerRegistry, Socio::class);
    }

    public function save(Socio $socio){
        $this->getEntityManager()->persist($socio);
        $this->getEntityManager()->flush();
    }

    public function delete(int $id){        
        $this->getEntityManager()->remove($this->find($id));
        $this->getEntityManager()->flush();
    }
}