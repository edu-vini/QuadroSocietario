<?php

namespace App\Api\Service;
use App\Entity\Socio;
use App\Repository\EmpresaRepository;
use App\Repository\SocioRepository;
use Symfony\Component\HttpFoundation\Request;

class SocioService {
    public function __construct(
        private SocioRepository $socioRepository,
        private EmpresaRepository $empresaRepository
    ){}

    public function getAll(): ?array {
        return $this->socioRepository->findAll();
    }

    public function get(int $id): ?Socio {
        return $this->socioRepository->find($id);
    }

    public function post(Request $request): array {
        $socio = new Socio();
        $socio->setCpf($request->getPayload()->get('cpf'));
        $socio->setNome($request->getPayload()->get('nome'));
        $socio->setEndereco($request->getPayload()->get('endereco'));
        $socio->setTelefone($request->getPayload()->get('telefone'));
        if(($request->getPayload()->has('empresas'))){
            $empresas = $request->toArray()['empresas'];
            foreach($empresas as $empresa) {
                $socio->addEmpresa($this->empresaRepository->find($empresa['id']));
            }
        }
        $this->socioRepository->save($socio);

        return [
            'status'=>'success',
            'message'=> 'Sócio Criado com Sucesso!'
        ];
    }

    public function put(int $id, Request $request): array {
        $socio = $this->socioRepository->find($id);

        if($request->getPayload()->has('cpf')){
            $socio->setCpf($request->getPayload()->get('cpf'));
        }
        if($request->getPayload()->has('nome')){
            $socio->setNome($request->getPayload()->get('nome'));
        }
        if($request->getPayload()->has('endereco')){
            $socio->setEndereco($request->getPayload()->get('endereco'));
        }
        if($request->getPayload()->has('telefone')){
            $socio->setTelefone($request->getPayload()->get('telefone'));
        }
        if($request->getPayload()->has('empresas')){
            $empresas = $request->toArray()['empresas'];
            if(!empty($empresas) ){
                foreach($empresas as $empresa) {
                    $socio->addEmpresa($this->empresaRepository->find($empresa['id']));
                }
            }
        }
        
        $this->socioRepository->save($socio);

        return [
            'status'=>'success',
            'message'=> 'Sócio Atualizado com Sucesso!'
        ];
    }

    public function delete(int $id): array {
        $this->socioRepository->delete($id);
        return [
            'status'=>'success',
            'message'=> 'Sócio Excluído com Sucesso!'
        ];
    }

    public function deleteEmpresa(int $idSocio, int $idEmpresa): array {
        $socio = $this->socioRepository->find($idSocio);
        $socio->removeEmpresa($this->empresaRepository->find($idEmpresa));
        $this->socioRepository->save($socio);
        return [
            'status'=>'success',
            'message'=> 'Empresa Removida do Sócio!'
        ];
    }
}