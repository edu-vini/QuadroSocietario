<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

#[ORM\Entity(repositoryClass: AccessToken::class)]
class AccessToken {
    #[ORM\Id]
    #[ORM\Column(type: 'string', unique: true)]
    private string $access_token;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $criadoEm;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $validoAte;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'id')]
    private Usuario $usuario;
    
    public function getToken(): string {
        return $this->access_token;
    }
    public function generateToken(): void {
        $this->access_token = base64_encode(
            $this->usuario->getNomeUsuario().
            $this->usuario->getPassword().
            $this->criadoEm->format('Y-m-dTH:i:s').
            $this->validoAte->format('Y-m-dTH:i:s')
        );
    }
    public function getValidoAte(): \DateTime {
        return $this->validoAte;
    }
    public function setValidoAte(\DateTime $validoAte): void {
        $this->validoAte = $validoAte;
    }
    public function getCriadoEm(): \DateTime {
        return $this->criadoEm;
    }
    public function setCriadoEm(\DateTime $criadoEm): void {
        $this->criadoEm = $criadoEm;
    }
    public function getUsuario(): Usuario {
        return $this->usuario;
    }
    public function setUsuario(Usuario $usuario){
        $this->usuario = $usuario;
    }
    public function isValid(): bool {
        return (new \DateTime()) <= $this->validoAte;
    }
    public function getUsuarioId(): int {
        return $this->usuario->getId();
    }
}