<?php

namespace App\Api\Controller;

use App\Api\Service\SocioService;
use App\Entity\Socio;
use App\Repository\SocioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route(path: '/api/socio')]
class SocioController extends AbstractController {
    public function __construct(
        private SocioService $socioService
    ){}

    #[Route(path: '', methods: ['GET'])]
    public function getAll(): Response {
        return $this->json($this->socioService->getAll());
    }

    #[Route(path: '/{id}', methods: ['GET'])]
    public function get(int $id): Response {
        return $this->json($this->socioService->get($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function post(Request $request): Response {
        return $this->json($this->socioService->post($request));
    }

    #[Route(path: '/{id}', methods: ['PUT'])]
    public function put(int $id, Request $request): Response {
        return $this->json($this->socioService->put($id, $request));
    }

    #[Route(path: '/{id}', methods: ['DELETE'])]
    public function delete(int $id): Response {
        return $this->json($this->socioService->delete($id));
    }

    #[Route(path: '/{idSocio}/empresa/{idEmpresa}', methods: ['DELETE'])]
    public function deleteEmpresa(int $idSocio, int $idEmpresa): Response {
        return $this->json($this->socioService->deleteEmpresa($idSocio, $idEmpresa));
    }
}