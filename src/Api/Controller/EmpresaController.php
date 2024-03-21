<?php

namespace App\Api\Controller;

use App\Entity\Empresa;
use App\Form\Type\EmpresaType;
use App\Repository\EmpresaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[Route(path: '/api/empresa')]
class EmpresaController extends AbstractController {

    private EmpresaRepository $empresaRepository;

    public function __construct(EmpresaRepository $empresaRepository){
        $this->empresaRepository = $empresaRepository;
    }
    
    #[OA\Get(
        path:'/api/empresa',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo as Empresas.')
        ],
        tags: [
            'Empresa'
        ]
    )]
    #[Route(path: '', methods: ['GET'])]
    public function getAll(): Response {
        return $this->json($this->empresaRepository->findAll());
    }
    
    #[OA\Get(
        path:'/api/empresa/{id}',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo uma Empresa.')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id',name: 'id')
        ],
        tags: [
            'Empresa'
        ]
    )]
    #[Route(path: '/{id}', methods: ['GET'])]
    public function get (int $id ): Response {
        return $this->json($this->empresaRepository->find($id));
    }

    #[OA\Post(
        path: '/api/empresa',
        responses: [
            new OA\Response(response: '200', description: 'Empresa Incluída com Sucesso!')
        ],
        requestBody: new OA\RequestBody(ref: '#components/requestBodies/Empresa'),
        tags: [
            'Empresa'
        ]
    )]
    #[Route(path: '', methods: ['POST'])]
    public function post (Request $request): Response {
        try {
            $empresa = new Empresa();
            $empresa->setCnpj($request->getPayload()->get('cnpj'));
            $empresa->setRazaoSocial($request->getPayload()->get('razaoSocial'));
            $empresa->setFantasia($request->getPayload()->get('fantasia'));
            $empresa->setEndereco($request->getPayload()->get('endereco'));
            $empresa->setTelefone($request->getPayload()->get('telefone'));
            $this->empresaRepository->save($empresa);
        } catch (\TypeError $e){
            return $this->json([
                'status'=>'error',
                'message'=> $e->getMessage()
            ], 400);
        } catch (\Exception $e){
            return $this->json([
                'status'=>'error',
                'message'=> $e->getMessage()
            ], 400);
        }
        
        return $this->json([
            'status' => 'success',
            'message' => 'Empresa Incluída com Sucesso!'
        ]);   
    }

    #[OA\Put(
        path: '/api/empresa/{id}',
        responses: [
            new OA\Response(response: '200', description: 'Empresa Editada com Sucesso!')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id',name: 'id')
        ],
        requestBody: new OA\RequestBody(ref: '#components/requestBodies/Empresa'),
        tags: [
            'Empresa'
        ]
    )]
    #[Route(path: '/{id}', methods: ['PUT'])]
    public function put (int $id, Request $request): Response {
        try {
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
        } catch (\TypeError $e){
            return $this->json([
                'status'=>'error',
                'message'=> $e->getMessage()
            ], 400);
        } catch (\Exception $e){
            return $this->json([
                'status'=>'error',
                'message'=> $e->getMessage()
            ], 400);
        }
        
        return $this->json([
            'status' => 'success',
            'message' => 'Empresa Atualizada com Sucesso!'
        ]);   
    }

    #[OA\Delete(
        path: '/api/empresa/{id}',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo a Empresas.')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id',name: 'id')
        ],
        tags: [
            'Empresa'
        ]
    )]
    #[Route(path: '/{id}', methods: ['DELETE'])]
    public function delete(int $id): Response {
        try{
            $this->empresaRepository->delete($id);
        } catch (\TypeError $e){
            return $this->json([
                'status'=>'error',
                'message'=> $e->getMessage()
            ], 400);
        } catch (\Exception $e){
            return $this->json([
                'status'=>'error',
                'message'=> $e->getMessage()
            ], 400);
        }

        return $this->json([
            'status'=>'success',
            'message'=>'Empresa excluída com sucesso!'
        ]);
    }
}