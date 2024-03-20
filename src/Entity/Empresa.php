<?php

namespace App\Entity;

use App\Repository\EmpresaRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: EmpresaRepository::class)]
class Empresa {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    protected ?int $id;

    #[ORM\Column(type: "string", length: 14)]
    protected ?string $cnpj;

    #[ORM\Column(type: "string")]
    protected ?string $razaoSocial;

    #[ORM\Column(type: "string")]
    protected ?string $fantasia;

    #[ORM\Column(type: "string")]
    protected ?string $endereco;

    #[ORM\Column(type: "string", length: 11)]
    protected ?string $telefone;

    public function getId(): int {
        return $this->id;
    }

    public function setCnpj(string $cnpj): void {
        $this->cnpj = $cnpj;
    }

    public function getCnpj(): string {
        return $this->cnpj;
    }

    public function setRazaoSocial(string $razaoSocial): void {
        $this->razaoSocial = $razaoSocial;
    }

    public function getRazaoSocial(): string {
        return $this->razaoSocial;
    }

    public function setFantasia(string $fantasia): void {
        $this->fantasia = $fantasia;
    }

    public function getFantasia(): string {
        return $this->fantasia;
    }

    public function setEndereco(string $endereco): void {
        $this->endereco = $endereco;
    }

    public function getEndereco(): string {
        return $this->endereco;
    }

    public function setTelefone(string $telefone): void {
        $this->telefone = $telefone;
    }

    public function getTelefone(): string {
        return $this->telefone;
    }

}