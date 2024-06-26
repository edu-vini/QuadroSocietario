<?php

namespace App\Controller;

use App\Entity\Socio;
use App\Form\Type\SocioType;
use App\Repository\EmpresaRepository;
use App\Repository\SocioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_SOCIO')]
class SocioController extends AbstractController {
    public function __construct(
        private SocioRepository $socioRepository, 
        private EmpresaRepository $empresaRepository) {
    }

    #[Route(path: '/socio/incluir', name: "form_socio")]
    public function new(Request $request): Response {
        $socio = new Socio();

        $form = $this->createForm(SocioType::class, $socio, [
            'empresas' => $this->empresaRepository->findAll()
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $socio = $form->getData();
            $this->socioRepository->save($socio);
            $this->addFlash("success","Socio criado com sucesso!");
            return $this->redirectToRoute('list_socio');
        }

        return $this->render('socio/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route(path: '/socio/{id}', name: "form_socio_edit")]
    public function edit(int $id, Request $request): Response {
        $socio = $this->socioRepository->find($id);
        $form = $this->createForm(SocioType::class, $socio, [
            'empresas' => $this->empresaRepository->findAll()
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $socio = $form->getData();
            $this->socioRepository->save($socio);
            $this->addFlash("success","Socio editado com sucesso!");
            return $this->redirectToRoute('list_socio');
        }

        return $this->render('socio/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route(path:'/socio/{id}/excluir', name: 'delete_socio')]
    public function delete(int $id): Response {
        $this->socioRepository->delete($id);        
        return $this->redirectToRoute('list_socio');
    }

    #[Route(path:'/socio', name: 'list_socio')]
    public function list(): Response {
        $socios = $this->socioRepository->findAll();
        return $this->render('socio/list.html.twig', [
            "list" => $socios
        ]);
    }
}