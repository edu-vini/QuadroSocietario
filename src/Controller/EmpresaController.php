<?php

namespace App\Controller;

use App\Entity\Empresa;
use App\Form\Type\EmpresaType;
use App\Repository\EmpresaRepository;
use App\Repository\SocioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_EMPRESA')]
class EmpresaController extends AbstractController {
    private EmpresaRepository $empresaRepository;
    private SocioRepository $socioRepository;
    public function __construct(EmpresaRepository $empresaRepository, SocioRepository $socioRepository){
        $this->empresaRepository = $empresaRepository;
        $this->socioRepository = $socioRepository;
    }

    #[Route(path: '/empresa/incluir', name: "form_empresa")]
    public function new(Request $request): Response {
        $empresa = new Empresa();
        
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $empresa = $form->getData();
            $this->empresaRepository->save($empresa);  
            // $this->addFlash("success","Empresa criada com sucesso!");
            return $this->redirectToRoute('list_empresa');
        }

        return $this->render('empresa/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route(path: '/empresa/{id}', name: "form_empresa_edit")]
    public function edit(int $id, Request $request): Response {
        
        $empresa = $this->empresaRepository->find($id);
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $empresa = $form->getData();
            $this->empresaRepository->save($empresa);
            // $this->addFlash("success","Empresa editada com sucesso!");
            return $this->redirectToRoute('list_empresa');
        }

        return $this->render('empresa/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route(path:'/empresa/{id}/excluir', name: 'delete_empresa')]
    public function delete(int $id): Response {
        $this->empresaRepository->delete($id);        
        return $this->redirectToRoute('list_empresa');
    }

    #[Route(path:'/empresa',name:'list_empresa')]
    public function list(): Response {
        $empresas = $this->empresaRepository->findAll();

        return $this->render('empresa/list.html.twig', [
            'list' => $empresas
        ]);
    }
}