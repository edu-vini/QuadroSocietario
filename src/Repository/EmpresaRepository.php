<?php

namespace App\Repository;

use App\Entity\Empresa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EmpresaRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $managerRegistry){
        parent::__construct($managerRegistry, Empresa::class);
    }

    public function save(Empresa $empresa){
        $this->getEntityManager()->persist($empresa);
        $this->getEntityManager()->flush();
    }

    public function delete(int $id){        
        $this->getEntityManager()->remove($this->find($id));
        $this->getEntityManager()->flush();
    }
}