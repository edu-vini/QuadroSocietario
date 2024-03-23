<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario implements  UserInterface, PasswordAuthenticatedUserInterface {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 20, unique: true)]
    private string $nomeUsuario;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private string $senha;

    public function getId(): int {
        return $this->id;
    }

    public function getNomeUsuario(): string {
        return $this->nomeUsuario;
    }

    public function setNomeUsuario(string $nomeUsuario): void {
        $this->nomeUsuario = $nomeUsuario;
    }

    public function getUserIdentifier(): string {
        return $this->nomeUsuario;
    }

    public function getRoles(): array {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): self {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->senha;
    }

    public function setPassword(string $password): self {
        $this->senha = $password;
        return $this;
    }

    public function eraseCredentials(): void {
        
    }
}