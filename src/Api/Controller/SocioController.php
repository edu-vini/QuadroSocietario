<?php

namespace App\Api\Controller;

use App\Api\Entity\Empresa;
use App\Entity\Socio;
use App\Form\Type\EmpresaType;
use App\Repository\SocioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;

#[Route(path: '/api/socio')]
class SocioController extends AbstractController {
    private SocioRepository $socioRepository;
    public function __construct(SocioRepository $socioRepository){
        $this->socioRepository = $socioRepository;
    }

    #[OA\Get(
        path: '/api/socio',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo as Empresas.')
        ],
        tags: [
            'Sócio'
        ]
    )]
    #[Route(path: '', methods: ['GET'])]
    public function getAll(): Response {
        return $this->json($this->socioRepository->findAll());
    }

    #[OA\Get(
        path: '/api/socio/{id}',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo a Empresas.')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id',name: 'id')
        ],
        tags: [
            'Sócio'
        ]
    )]
    #[Route(path: '/{id}', methods: ['GET'])]
    public function get(int $id): Response {
        return $this->json($this->socioRepository->find($id));
    }

    #[OA\Post(
        path: '/api/socio',
        responses: [
            new OA\Response(response: '200', description: 'Empresa Criada com Sucesso!')
        ],
        requestBody: new OA\RequestBody(ref: '#components/requestBodies/Socio'),
        tags: [
            'Sócio'
        ]
    )]
    #[Route(path: '', methods: ['POST'])]
    public function post(Request $request): Response {
        try {
            $socio = new Socio();
            $socio->setCpf($request->getPayload()->get('cpf'));
            $socio->setNome($request->getPayload()->get('nome'));
            $socio->setEndereco($request->getPayload()->get('endereco'));
            $socio->setTelefone($request->getPayload()->get('telefone'));
            $this->socioRepository->save($socio);
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
            'message'=> 'Empresa Criada com Sucesso!'
        ]);
    }

    #[OA\Put(
        path: '/api/socio/{id}',
        responses: [
            new OA\Response(response: '200', description: 'Empresa Criada com Sucesso!')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id',name: 'id')
        ],
        requestBody: new OA\RequestBody(ref: '#components/requestBodies/Socio'),
        tags: [
            'Sócio'
        ]
    )]
    #[Route(path: '/{id}', methods: ['PUT'])]
    public function put(int $id, Request $request): Response {
        try {
            $socio = $this->socioRepository->find($id);

            if($request->getPayload()->has('cpf')){
                $socio->setCpf($request->getPayload()->get('cpf'));
            }
            if($request->getPayload()->has('nome')){
                $socio->setCpf($request->getPayload()->get('nome'));
            }
            if($request->getPayload()->has('endereco')){
                $socio->setCpf($request->getPayload()->get('endereco'));
            }
            if($request->getPayload()->has('telefone')){
                $socio->setCpf($request->getPayload()->get('telefone'));
            }

            $this->socioRepository->save($socio);
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
            'message'=> 'Empresa Atualizada com Sucesso!'
        ]);
    }

    #[OA\Delete(
        path: '/api/socio/{id}',
        responses: [
            new OA\Response(response: '200', description: 'JSON Contendo a Empresas.')
        ],
        parameters: [
            new OA\PathParameter(parameter: 'id',name: 'id')
        ],
        tags: [
            'Sócio'
        ]
    )]
    #[Route(path: '/{id}', methods: ['DELETE'])]
    public function delete(int $id): Response {
        try{
            $this->socioRepository->delete($id);
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
            'message'=>'Sócio deletado com Sucesso!'
        ]);
    }

}