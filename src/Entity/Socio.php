<?php

namespace App\Entity;

use App\Repository\SocioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocioRepository::class)]
class Socio {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private int $id;
    
    #[ORM\Column(type: "string",length: 11)]
    private $cpf;

    #[ORM\Column(type: "string")]
    private $nome;

    #[ORM\Column(type: "string")]
    private $endereco;

    #[ORM\Column(type: "string",length: 11)]
    private $telefone;

    #[ORM\ManyToMany(targetEntity: Empresa::class, inversedBy: 'socios')]
    #[ORM\JoinTable(name: 'socio_empresa')]
    private Collection $empresas;

    public function __construct(){
        $this->empresas = new ArrayCollection();
    }

    public function getId(): int {
        return $this->id;
    }

    public function setCpf(string $cpf): void {
        $this->cpf = $cpf;
    }

    public function getCpf(): string {
        return $this->cpf;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function getNome(): string {
        return $this->nome;
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

    public function addEmpresa(Empresa $empresa): self {
        if(!$this->empresas->contains($empresa)){
            $empresa->addSocio($this);
            $this->empresas[] = $empresa;
        }
        return $this;
    }

    public function getEmpresas(): Collection{
        return $this->empresas;
    }

    public function removeEmpresa(Empresa $empresa): self {
        if($this->empresas->contains($empresa)){
            $empresa->removeSocio($this);
            $this->empresas->removeElement($empresa);
        }
        return $this;
    }


}