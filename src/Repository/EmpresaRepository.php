<?php

namespace App\Repository;

use App\Entity\Empresa;
use App\Service\EmpresaService;
use Doctrine\Persistence\ManagerRegistry;

class EmpresaRepository extends AbstractRepository {
    protected string $entityManager = Empresa::class;
    public function __construct(
        private EmpresaService $empresaService,
        ManagerRegistry $managerRegistry,
    ){
        parent::__construct($managerRegistry);
    }

    public function save($empresa): void {
        $this->empresaService->removeChars($empresa);
        $this->getEntityManager()->persist($empresa);
        $this->getEntityManager()->flush();
    }

    public function findSocios(int $id): array {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "
            SELECT s.id, s.cpf, s.nome, s.endereco, s.telefone
            FROM socio s LEFT JOIN socio_empresa se ON s.id = se.socio_id
            WHERE se.empresa_id = :id 
        ";
        $result = $conn->executeQuery($sql, ['id'=>$id]);
        return $result->fetchAllAssociative();
    }
}