<?php

namespace App\Repository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

abstract class AbstractRepository extends ServiceEntityRepository {
    
    public function __construct(ManagerRegistry $managerRegistry){
        parent::__construct($managerRegistry, $this->entityManager);
    }

    public function save($entity){
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function delete(int $id){        
        $this->getEntityManager()->remove($this->find($id));
        $this->getEntityManager()->flush();
    }
}