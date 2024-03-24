<?php

namespace App\Api\Service;
use App\Entity\Empresa;
use App\Repository\EmpresaRepository;
use Symfony\Component\HttpFoundation\Request;

class EmpresaService {
    public function __construct(
        private EmpresaRepository $empresaRepository
    ){}

    public function getAll(): array {
        return $this->empresaRepository->findAll();
    }

    public function get(int $id): Empresa {
        return $this->empresaRepository->find($id);
    }

    public function post(Request $request): array {
        $empresa = new Empresa();
        $empresa->setCnpj($request->getPayload()->get('cnpj'));
        $empresa->setRazaoSocial($request->getPayload()->get('razaoSocial'));
        $empresa->setFantasia($request->getPayload()->get('fantasia'));
        $empresa->setEndereco($request->getPayload()->get('endereco'));
        $empresa->setTelefone($request->getPayload()->get('telefone'));
        $this->empresaRepository->save($empresa);

        return [
            'status' => 'success',
            'message' => 'Empresa Incluída com Sucesso!'
        ];
    }

    public function put(Request $request, int $id): array {
        $empresa = $this->empresaRepository->find($id);

        if($request->getPayload()->has('cnpj')){
            $empresa->setCnpj($request->getPayload()->get('cnpj'));
        }
        if($request->getPayload()->has('razaoSocial')){
            $empresa->setCnpj($request->getPayload()->get('razaoSocial'));
        }
        if($request->getPayload()->has('fantasia')){
            $empresa->setCnpj($request->getPayload()->get('fantasia'));
        }
        if($request->getPayload()->has('endereco')){
            $empresa->setCnpj($request->getPayload()->get('endereco'));
        }
        if($request->getPayload()->has('telefone')){
            $empresa->setCnpj($request->getPayload()->get('telefone'));
        }
        $this->empresaRepository->save($empresa);
        return [
            'status' => 'success',
            'message' => 'Empresa Atualizada com Sucesso!'
        ];
    }

    public function getSocios(int $id): array {
        return $this->empresaRepository->findSocios($id);
    }

    public function delete(int $id): array {
        $this->empresaRepository->delete($id);
        return [
            'status'=>'success',
            'message'=>'Empresa excluída com sucesso!'
        ];
    }
}