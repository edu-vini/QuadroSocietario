<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
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


}