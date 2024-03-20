<?php

namespace App\Entity;

use App\Repository\EmpresaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

#[ORM\Entity(repositoryClass: EmpresaRepository::class)]
class Empresa {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id;

    #[ORM\Column(type: "string", length: 14)]
    private string $cnpj;

    #[ORM\Column(type: "string")]
    private string $razaoSocial;

    #[ORM\Column(type: "string")]
    private string $fantasia;

    #[ORM\Column(type: "string")]
    private string $endereco;

    #[ORM\Column(type: "string", length: 11)]
    private string $telefone;

    #[ORM\ManyToMany(targetEntity: Socio::class, mappedBy: 'empresas')]
    private Collection $socios;

    public function __construct(){
        $this->socios = new ArrayCollection();
    }

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

    public function addSocio(Socio $socio): self {
        if(!$this->socios->contains($socio)){
            $this->socios[] = $socio;
            $socio->addEmpresa($this);
        }
        return $this;
    }
    
    public function getSocios(): Collection {
        return $this->socios;
    }

    public function removeSocio(Socio $socio): self {
        if($this->socios->contains($socio)){
            $this->socios->removeElement($socio);
        }
        return $this;
    }

}