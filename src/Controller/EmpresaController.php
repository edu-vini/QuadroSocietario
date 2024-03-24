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

#[Route(path: '/empresa')]
class EmpresaController extends AbstractController {
    public function __construct(
        private EmpresaRepository $empresaRepository, 
        private SocioRepository $socioRepository
    ){}

    #[Route(path: '/incluir', name: "form_empresa")]
    public function new(Request $request): Response {
        $empresa = new Empresa();
        
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $empresa = $form->getData();
            $this->empresaRepository->save($empresa);  
            $this->addFlash("success","Empresa criada com sucesso!");
            return $this->redirectToRoute('list_empresa');
        }

        return $this->render('empresa/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route(path: '/{id}', name: "form_empresa_edit")]
    public function edit(int $id, Request $request): Response {
        
        $empresa = $this->empresaRepository->find($id);
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $empresa = $form->getData();
            $this->empresaRepository->save($empresa);
            $this->addFlash("success","Empresa editada com sucesso!");
            return $this->redirectToRoute('list_empresa');
        }

        return $this->render('empresa/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route(path:'/{id}/excluir', name: 'delete_empresa')]
    public function delete(int $id): Response {
        $this->empresaRepository->delete($id);        
        return $this->redirectToRoute('list_empresa');
    }

    #[Route(path:'',name:'list_empresa')]
    public function list(): Response {
        $empresas = $this->empresaRepository->findAll();

        return $this->render('empresa/list.html.twig', [
            'list' => $empresas
        ]);
    }

    #[Route(path:'/{id}/socios', name: 'list_socio_empresa')]
    public function listSocios(int $id): response {
        $empresa = $this->empresaRepository->find($id);
        $socios = $this->empresaRepository->getSocios($empresa);
        return $this->render('empresa/socios.html.twig',[
            'list' => $socios,
            'empresa'=>$empresa
        ]);
    }

    #[Route(path:'/{idEmpresa}/socio/{idSocio}/remover', name: 'remover_socio_empresa')]
    public function removerSocio(int $idEmpresa, int $idSocio): response {

        $socio = $this->socioRepository->find($idSocio);
        $socio->removeEmpresa($this->empresaRepository->find($idEmpresa));
        $this->socioRepository->save($socio);

        return $this->redirectToRoute('list_socio_empresa',['id'=>$idEmpresa]);
    }
}