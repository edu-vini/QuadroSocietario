<?php

namespace App\Api\Controller;

use App\Api\Service\EmpresaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/empresa')]
class EmpresaController extends AbstractController {
    public function __construct(
        private EmpresaService $empresaService
    ){}
    
    #[Route(path: '', methods: ['GET'])]
    public function getAll(): Response {
        return $this->json($this->empresaService->getAll());
    }
    
    #[Route(path: '/{id}', methods: ['GET'])]
    public function get (int $id ): Response {
        return $this->json($this->empresaService->get($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function post (Request $request): Response {
        return $this->json($this->empresaService->post($request));   
    }

    #[Route(path: '/{id}', methods: ['PUT'])]
    public function put (int $id, Request $request): Response {
        return $this->json($this->empresaService->put($request, $id));
    }

    #[Route(path: '/{id}/socios')]
    public function getSocios(int $id): Response {
        return $this->json($this->empresaService->getSocios($id));
    }

    #[Route(path: '/{id}', methods: ['DELETE'])]
    public function delete(int $id): Response {
        return $this->json($this->empresaService->delete($id));
    }
}