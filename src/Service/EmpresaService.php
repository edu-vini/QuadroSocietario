<?php

namespace App\Service;
use App\Entity\Empresa;

class EmpresaService {
    public function __construct(
        private UtilsService $utilsService
    ){}
    public function removeChars(Empresa $empresa){
        $empresa->setCnpj($this->utilsService->removeChars($empresa->getCnpj()));
        $empresa->setTelefone($this->utilsService->removeChars($empresa->getTelefone()));
    }
}