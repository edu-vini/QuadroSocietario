<?php

namespace App\Service;
use App\Entity\Socio;

class SocioService {
    public function __construct(
        private UtilsService $utilsService
    ){}
    public function removeChars(Socio $socio) {
        $socio->setCpf($this->utilsService->removeChars($socio->getCpf()));
        $socio->setTelefone($this->utilsService->removeChars($socio->getTelefone()));
    }
}